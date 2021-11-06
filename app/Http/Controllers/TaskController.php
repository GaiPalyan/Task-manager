<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\TaskManager;
use App\Http\Requests\TaskRequests\StoreRequest;
use App\Http\Requests\TaskRequests\UpdateRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    public TaskManager $taskManager;
    /**
     * @param TaskManager $taskManager
     */
    public function __construct(TaskManager $taskManager)
    {
        $this->taskManager = $taskManager;
        $this->authorizeResource(Task::class, 'task');
    }

    /**
     * Display a listing of the tasks.
     *
     * @return View
     */
    public function index(): View
    {
        $availableOptions = $this->taskManager->getFilterOptions();
        $tasks = $this->taskManager->getTaskList();
        return view('app.tasks.show', compact('tasks', 'availableOptions'));
    }

    /**
     * Show the form for creating a new tasks.
     *
     * @return View
     */
    public function create(): View
    {
        $creatingOptions = $this->taskManager->getCreatingOptions();
        return view('app.tasks.create', compact('creatingOptions'));
    }

    /**
     * Store a newly created tasks in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->taskManager->saveTask($request->all(), auth()->user());
        flash(__('Задача успешно создана'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the tasks.
     *
     * @param Task $task
     * @return View
     */
    public function show(Task $task): View
    {
        $taskData = $this->taskManager->getTaskRelatedData($task);
        return view('app.tasks.task_page', compact('task', 'taskData'));
    }

    /**
     * Show the form for editing the tasks.
     *
     * @param Task $task
     * @return View
     */
    public function edit(Task $task): View
    {
        $availableOptions = array_merge(
            $this->taskManager->getUpdatingOptions($task),
            $this->taskManager->getTaskRelatedData($task)
        );

        return view('app.tasks.edit', compact('task', 'availableOptions'));
    }

    /**
     * Update the tasks in storage.
     *
     * @param UpdateRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Task $task): RedirectResponse
    {
        $this->taskManager->updateTask($request->all(), $task);
        flash(__('Задача успешно изменена'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the tasks from storage.
     *
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->taskManager->deleteTask($task);
        flash(__('Задача успешно удалена'))->success();
        return redirect()->route('tasks.index');
    }
}
