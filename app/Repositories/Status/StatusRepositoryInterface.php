<?php

namespace App\Repositories\Status;

use App\Models\TaskStatus;
use Illuminate\Contracts\Auth\Authenticatable;

interface StatusRepositoryInterface
{
    public function getList(): array;
    public function getStatusById(int $id): TaskStatus;
    public function getUniqueNamedList(): array;
    public function store(array $data, Authenticatable $creator): void;
    public function update(array $data, TaskStatus $status): void;
    public function delete(TaskStatus $status);
}