<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\StatusManager;
use App\Http\Requests\StatusRequests\StatusRequestValidator;
use App\Http\Requests\StatusRequests\UpdateRequestValidator;
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

    public function store(StatusRequestValidator $request): RedirectResponse
    {
        $this->statusManager->saveStatus($request->inputData());
        flash(__('flash-messages.statusWasCreated'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $status): View
    {
        return  view('app.statuses.edit', compact('status'));
    }

    public function update(StatusRequestValidator $request, TaskStatus $status): RedirectResponse
    {
        $this->statusManager->updateStatus($request->inputData(), $status);
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
