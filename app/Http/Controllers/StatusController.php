<?php

declare(strict_types=1);

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
        $this->authorizeResource(TaskStatus::class, 'status');
    }

    public function index(): View
    {
        return view('app.statuses.show', $this->statusManager->getStatusList());
    }

    public function create(): View
    {
        return view('app.statuses.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->statusManager->saveStatus($request->all());
        flash(__('flash-messages.statusWasCreated'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $status): View
    {
        return  view('app.statuses.edit', compact('status'));
    }

    public function update(UpdateRequest $request, TaskStatus $status): RedirectResponse
    {
        $this->statusManager->updateStatus($request->all(), $status);
        flash(__('flash-messages.statusWasUpdated'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $status): RedirectResponse
    {
        if ($this->statusManager->isAssociated($status)) {
            flash(__('flash-messages.statusWasNotDeleted'))->error();
            return redirect()->route('task_statuses.index');
        }

        $this->statusManager->deleteStatus($status);
        flash(__('flash-messages.statusWasDeleted'))->success();

        return redirect()->route('task_statuses.index');
    }
}
