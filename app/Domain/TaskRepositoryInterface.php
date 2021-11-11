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
    public function getUniqueTaskCreators(): array;
    public function getUniqueAssignedPerformers(): array;
    public function getStatus(Task $task): array;
    public function getTaskPerformer(Task $task): array;
    public function getTaskLabels(Task $task): array;
    public function getPerformers(): array;
}
