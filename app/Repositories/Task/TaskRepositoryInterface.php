<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\TaskStatus;

interface TaskRepositoryInterface
{
    public function store(int $creatorId, array $data, TaskStatus $status);
    public function getList(): Task;
}