<?php

declare(strict_types=1);

namespace App\Repositories\Status;

use App\Models\TaskStatus;
use Illuminate\Support\Collection;

class StatusRepository implements StatusRepositoryInterface
{

    public function getList(): array
    {
        $statuses = TaskStatus::select('id', 'name', 'created_at')->orderByDesc('created_at')->paginate(10);
        return compact('statuses');
    }

    public function getAll(): Collection
    {
        return TaskStatus::all();
    }

    public function store(array $name): void
    {
        TaskStatus::create($name);
    }

    public function getStatusById(int $id): TaskStatus
    {
        return TaskStatus::findOrFail($id);
    }

    public function update(array $data, TaskStatus $status): void
    {
        $status->fill($data);
        $status->save();
    }

    public function delete(TaskStatus $status)
    {
        try {
            $status->delete();
        } catch (\Exception $exception) {
            return $exception->getCode();
        }
    }
}
