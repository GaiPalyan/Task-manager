<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function store(Authenticatable $creator, array $inputData, TaskStatus $status): void;
    public function getList(): LengthAwarePaginator;
    public function update(array $inputData, Task $task): void;
    public function delete(Task $task): void;
    public function getAvailableFilterOptions(): Collection;
    public function getAssignedPerformersList(): Collection;
    public function getStatus(Task $task): TaskStatus | BelongsTo;
    public function getTaskPerformer(Task $task): User | BelongsTo;
    public function getTaskLabels(Task $task): Collection;
}