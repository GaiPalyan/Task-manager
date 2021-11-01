<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskRepositoryInterface
{

    public function getList(): LengthAwarePaginator
    {
        return Task::join('task_statuses as statuses', 'tasks.status_id', '=', 'statuses.id')
            ->join('users', 'tasks.created_by_id', '=', 'users.id')
            ->selectRaw('tasks.*, statuses.name as status_name, users.name as creator_name')->paginate(10);
    }

    public function getCreators()
    {
        return Task::join('users', 'tasks.created_by_id', '=', 'users.id')
            ->selectRaw('users.*')
            ->get();
    }

    public function store(Authenticatable $creator, array $data, TaskStatus $status): void
    {
        $task = User::findOrFail($creator->getAuthIdentifier())
            ->task()
            ->make($data)
            ->status()
            ->associate($status);

        $task->save();
        if (isset($data['labels'])) {
            $task->labels()->attach($data['labels']);
        }
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