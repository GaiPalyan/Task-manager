<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\TaskManager;
use App\Http\Requests\TaskRequests\StoreRequest;
use App\Http\Requests\TaskRequests\UpdateRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    public TaskManager $taskManager;

    public function __construct(TaskManager $taskManager)
    {
        $this->taskManager = $taskManager;
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(): View
    {
        return view(
            'app.tasks.index',
            $this->taskManager->getTaskList(),
            $this->taskManager->getFilterOptions(),
        );
    }

    public function create(): View
    {
        return view('app.tasks.create', $this->taskManager->getOptions());
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $user = auth()->user();
        if (!$user instanceof User) {
            abort(404);
        }

        $this->taskManager->saveTask($request->inputData(), $user);
        flash(__('flash-messages.taskWasCreated'))->success();

        return redirect()->route('tasks.index');
    }

    public function show(Task $task): View
    {
        return view(
            'app.tasks.show',
            $this->taskManager->getTaskRelatedData($task)
        );
    }

    public function edit(Task $task): View
    {
        return view(
            'app.tasks.edit',
            $this->taskManager->getOptions(),
            $this->taskManager->getTaskRelatedData($task)
        );
    }

    public function update(UpdateRequest $request, Task $task): RedirectResponse
    {
        $this->taskManager->updateTask($request->all(), $task);
        flash(__('flash-messages.taskWasUpdated'))->success();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->taskManager->deleteTask($task);
        flash(__('flash-messages.taskWasDeleted'))->success();
        return redirect()->route('tasks.index');
    }
}
