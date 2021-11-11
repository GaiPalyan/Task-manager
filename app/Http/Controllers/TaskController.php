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
        $availableOptions = $this->taskManager->getFilterOptions();
        return view(
            'app.tasks.show',
            compact('availableOptions'),
            $this->taskManager->getTaskList()
        );
    }

    public function create(): View
    {
        $creatingOptions = $this->taskManager->getCreatingOptions();
        return view('app.tasks.create', compact('creatingOptions'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $user = auth()->user();
        if (!$user instanceof User) {
            abort(404);
        }

        $this->taskManager->saveTask($request->all(), $user);
        flash(__('flash-messages.taskWasCreated'))->success();

        return redirect()->route('tasks.index');
    }

    public function show(Task $task): View
    {
        $taskData = $this->taskManager->getTaskRelatedData($task);
        return view('app.tasks.task_page', compact('task', 'taskData'));
    }

    public function edit(Task $task): View
    {
        $availableOptions = array_merge(
            $this->taskManager->getUpdatingOptions($task),
            $this->taskManager->getTaskRelatedData($task)
        );

        return view('app.tasks.edit', compact('task', 'availableOptions'));
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
