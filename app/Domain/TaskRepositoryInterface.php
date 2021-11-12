<?php

namespace App\Domain;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    public function store(User $creator, array $inputData, TaskStatus $status): void;
    public function getList(): LengthAwarePaginator;
    public function update(array $inputData, Task $task): void;
    public function delete(Task $task): void;
    public function getCreators(): array;
    public function getAssignedPerformers(): array;
    public function getRelatedData(Task $task, string $relation): array;
    public function getAvailablePerformers(): array;
}
