<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

class TaskRepository implements TaskRepositoryInterface
{
    public function getList(): Task
    {
        /*$list = Task::taskList();
        dd($list);*/
    }

    public function store(int $creatorId, array $data, TaskStatus $status)
    {
        $task = User::findOrFail($creatorId)
            ->task()
            ->make($data)
            ->status()
            ->associate($status);

        $task->save();
    }
}