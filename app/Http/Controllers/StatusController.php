<?php

namespace App\Http\Controllers;

use App\Domain\StatusManager;
use App\Http\Requests\StatusRequests\StoreRequest;
use App\Http\Requests\StatusRequests\UpdateRequest;
use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StatusController extends Controller
{
    public StatusManager $statusManager;
    public function __construct(StatusManager $statusManager)
    {
        $this->statusManager = $statusManager;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $statuses = $this->statusManager->getStatusList();
        return view('app.statuses.show', $statuses);
    }

    /**
     * @return View|RedirectResponse
     */
    public function create(): View | RedirectResponse
    {
        return auth()->user()
                ? view('app.statuses.create')
                : redirect()->route('statuses.index');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->statusManager->saveStatus($request->all(), auth()->user());
        flash(__('Статус создан'))->success();

        return redirect()->route('statuses.index');
    }

    /**
     * @param TaskStatus $status
     * @return View
     */
    public function edit(TaskStatus $status): View
    {
        return view('app.statuses.edit', compact('status'));
    }

    /**
     * @param UpdateRequest $request
     * @param TaskStatus $status
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, TaskStatus $status): RedirectResponse
    {
        $this->statusManager->updateStatus($request->all(), $status);
        flash(__('Статус обновлен'))->success();

        return redirect()->route('statuses.index');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(TaskStatus $status): RedirectResponse
    {
        if (!auth()->user() || $this->statusManager->isAssociated($status)) {
            flash(__('Не удалось удалить статус'))->error();
            return redirect()->route('statuses.index');
        }

        $this->statusManager->deleteStatus($status);
        flash(__('Статус удален'))->success();

        return redirect()->route('statuses.index');
    }
}
