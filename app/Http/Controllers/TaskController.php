<?php

namespace App\Http\Controllers;

use App\Domain\StatusManager;
use App\Domain\TaskManager;
use App\Http\Requests\TaskRequests\StoreRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
    public function index()
    {
       // $taskList = $this->taskManager->getTaskList();
        return view('app.tasks.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $availableStatuses = $this->taskManager->getUniqueStatuses();
        return view('app.tasks.create', $availableStatuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {

        $creatorId = auth()->id();
        $this->taskManager->saveTask($request->input(), $creatorId);
        flash(__('Задача успешно создана '))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
