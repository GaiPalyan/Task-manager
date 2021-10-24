<?php

namespace App\Http\Controllers;

use App\Domain\TaskManager;
use App\Http\Requests\TaskRequests\StoreRequest;
use App\Http\Requests\TaskRequests\UpdateRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TaskController extends Controller
{
    public TaskManager $taskManager;

    public function __construct(TaskManager $taskManager)
    {
        $this->taskManager = $taskManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
       $tasks = $this->taskManager->getTaskList();
       return view('app.tasks.show', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): View | RedirectResponse
    {
        $availableStatuses = $this->taskManager->getUniqueStatuses();

        return auth()->user()
                    ? view('app.tasks.create', $availableStatuses)
                    : redirect()->route('tasks.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->taskManager->saveTask($request->all(), auth()->user());
        flash(__('Задача успешно создана '))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return View
     */
    public function show(Task $task): View
    {
        $status = $this->taskManager->getTaskStatus($task);
        return view('app.tasks.task_page', compact('task', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return View
     */
    public function edit(Task $task): View
    {
        $availableStatuses = $this->taskManager->getUniqueStatuses();
        $status = $this->taskManager->getTaskStatus($task);
        return view('app.tasks.edit', $availableStatuses, compact('task', 'status'));
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task, Gate $response): RedirectResponse
    {
        if (!$response::inspect('task-delete', $task)->allowed()) {
            flash(__('Не удалось удалить задачу'))->error();
            return redirect()->route('tasks.index');
        }

        $this->taskManager->deleteTask($task);
        flash(__('Задача успешно удалена'))->success();
        return redirect()->route('tasks.index');
    }
}
