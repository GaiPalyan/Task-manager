<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Contracts\Auth\Authenticatable;

interface TaskRepositoryInterface
{
    public function store(Authenticatable $creator, array $data, TaskStatus $status): void;
    public function getList(): array;
    public function update(array $data, Task $task): void;
    public function delete(Task $task): void;
}