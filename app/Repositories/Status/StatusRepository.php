<?php

declare(strict_types=1);

namespace App\Repositories\Status;

use App\Domain\StatusRepositoryInterface;
use App\Models\TaskStatus;
use Illuminate\Pagination\LengthAwarePaginator;

class StatusRepository implements StatusRepositoryInterface
{

    public function getList(): LengthAwarePaginator
    {
        return TaskStatus::select('id', 'name', 'created_at')
                           ->orderByDesc('created_at')
                           ->paginate(10);
    }

    public function getAll(): array
    {
        return TaskStatus::getModels();
    }

    public function store(array $name): void
    {
        TaskStatus::create($name);
    }

    public function getStatusById(int $id): TaskStatus
    {
        return TaskStatus::find($id);
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
