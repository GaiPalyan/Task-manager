<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

interface TaskRepositoryInterface
{
    public function store(Authenticatable $creator, array $data, TaskStatus $status): void;
    public function getList(): LengthAwarePaginator;
    public function update(array $data, Task $task): void;
    public function delete(Task $task): void;
    public function getCreators();
}