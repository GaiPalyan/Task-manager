<?php

declare(strict_types=1);

namespace App\Domain;

use App\Models\TaskStatus;
use Illuminate\Pagination\LengthAwarePaginator;

interface StatusRepositoryInterface
{
    public function getList(): LengthAwarePaginator;
    public function getStatusById(int $id): TaskStatus;
    public function getAll(): array;
    public function store(array $data): void;
    public function update(array $data, TaskStatus $status): void;
    public function delete(TaskStatus $status);
}
