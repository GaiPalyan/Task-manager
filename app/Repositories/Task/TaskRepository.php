<?php

declare(strict_types=1);

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskRepository implements TaskRepositoryInterface
{

    public function getList(): LengthAwarePaginator
    {
        return QueryBuilder::for(Task::class)
            ->allowedFilters(
                [
                    AllowedFilter::exact('status_id'),
                    AllowedFilter::exact('created_by_id'),
                    AllowedFilter::exact('assigned_to_id'),
                ]
            )->paginate(10);
    }

    public function getAvailableFilterOptions(): Collection
    {
        return Task::join('users as creators', 'tasks.created_by_id', '=', 'creators.id')
             ->join('task_statuses as statuses', 'tasks.status_id', '=', 'statuses.id')
             ->selectRaw('creators.id as creator_id, creators.name as creator_name,
                          statuses.id as status_id, statuses.name as status_name')
             ->distinct()
             ->get();
    }

    public function getAssignedPerformersList(): Collection
    {
        return Task::join('users as performers', 'tasks.assigned_to_id', '=', 'performers.id')
             ->selectRaw('performers.id as performer_id, performers.name as performer_name')
             ->distinct()
             ->get();
    }

    public function getStatus(Task $task): TaskStatus | BelongsTo
    {
        return $task->status()->firstOrFail();
    }

    public function getTaskPerformer(Task $task): User | BelongsTo
    {
        return $task->performer()->firstOrFail();
    }

    public function getTaskLabels(Task $task): Collection
    {
        return $task->labels()->get();
    }

    public function store(Authenticatable $creator, array $inputData, TaskStatus $status): void
    {
        $task = User::findOrFail($creator->getAuthIdentifier())
            ->task()
            ->make($inputData)
            ->status()
            ->associate($status);
        $task->save();

        if (isset($inputData['labels'])) {
            $task->labels()->attach($inputData['labels']);
        }
    }

    public function update(array $inputData, Task $task): void
    {
        $task->fill($inputData);
        $task->save();

        if (isset($inputData['labels'])) {
            $task->labels()->sync($inputData['labels']);
        }
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}
