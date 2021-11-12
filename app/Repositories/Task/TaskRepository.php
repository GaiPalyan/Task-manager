<?php

declare(strict_types=1);

namespace App\Repositories\Task;

use App\Domain\TaskRepositoryInterface;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Exception;
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

    public function getCreators(): array
    {
        return Task::join('users as creators', 'tasks.created_by_id', '=', 'creators.id')
              ->selectRaw('creators.id, creators.name')
              ->pluck('name', 'id')
              ->toArray();
    }

    public function getAssignedPerformers(): array
    {
        return Task::join('users as performers', 'tasks.assigned_to_id', '=', 'performers.id')
              ->selectRaw('performers.id, performers.name')
              ->pluck('name', 'id')
              ->toArray();
    }

    public function getAvailablePerformers(): array
    {
        return User::pluck('name', 'id')->toArray();
    }

    /**
     * @throws Exception
     */
    public function getRelatedData(Task $task, string $relation): array
    {
        $result = match ($relation) {
            TaskStatus::class => $task->status(),
            Label::class => $task->labels(),
            User::class => $task->performer(),
            default => throw new Exception('Undefined relation'),
        };

        return $result->pluck('name', 'id')->toArray();
    }

    public function store(User $creator, array $inputData, TaskStatus $status): void
    {
        $task = User::find($creator->id)
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
