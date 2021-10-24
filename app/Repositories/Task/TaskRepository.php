<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class TaskRepository implements TaskRepositoryInterface
{

    public function getList(): array
    {
        $tasks = Task::taskList()->paginate(10);
        return compact('tasks');
    }

    public function store(Authenticatable $creator, array $data, TaskStatus $status): void
    {
        $task = User::findOrFail($creator->getAuthIdentifier())
            ->task()
            ->make($data)
            ->status()
            ->associate($status);

        $task->save();
    }

    public function update(array $data, Task $task): void
    {
        $task->fill($data);
        $task->save();
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}