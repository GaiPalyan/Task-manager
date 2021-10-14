<?php

namespace App\Repositories;

use App\Models\TaskStatus;

class StatusRepository implements DBRepositoryInterface
{
    public function getList(): array
    {
        $statuses = TaskStatus::statusesList()->paginate(10);
        return compact('statuses');
    }

    public function store(array $name): void
    {
        $status = TaskStatus::create($name);
        $status->save();
    }

    public function getItemById(int $id): array
    {
        $status = TaskStatus::findOrFail($id);
        return compact('status');
    }
}