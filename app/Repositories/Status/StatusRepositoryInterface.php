<?php

namespace App\Repositories\Status;

use App\Models\TaskStatus;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;

interface StatusRepositoryInterface
{
    public function getList(): array;
    public function getStatusById(int $id): TaskStatus;
    public function getAll(): Collection;
    public function store(array $data): void;
    public function update(array $data, TaskStatus $status): void;
    public function delete(TaskStatus $status);
}