<?php

declare(strict_types=1);

namespace App\Repositories\Task;

use App\Domain\TaskRepositoryInterface;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public function getUniqueTaskCreators(): array
    {
        return Task::join('users as creators', 'tasks.created_by_id', '=', 'creators.id')
              ->selectRaw('creators.id as creator_id, creators.name as creator_name')
              ->distinct()
              ->getModels();
    }

    public function getUniqueAssignedPerformers(): array
    {
        return Task::join('users as performers', 'tasks.assigned_to_id', '=', 'performers.id')
              ->selectRaw('performers.id as performer_id, performers.name as performer_name')
              ->distinct()
              ->getModels();
    }

    public function getStatus(Task $task): array
    {
        return $task->status()->getModels();
    }

    public function getTaskPerformer(Task $task): array
    {
        return $task->performer()->getModels();
    }

    public function getTaskLabels(Task $task): array
    {
        return $task->labels()->getModels();
    }

    public function store(User $creator, array $inputData, TaskStatus $status): void
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
