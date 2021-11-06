<?php

declare(strict_types=1);

namespace App\Repositories\Status;

use App\Models\TaskStatus;
use Illuminate\Support\Collection;

class StatusRepository implements StatusRepositoryInterface
{
    /**
     * @return array
     */
    public function getList(): array
    {
        $statuses = TaskStatus::select('id', 'name', 'created_at')->orderByDesc('created_at')->paginate(10);
        return compact('statuses');
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return TaskStatus::all();
    }

    /**
     * @param array $name
     */
    public function store(array $name): void
    {
        TaskStatus::create($name);
    }

    /**
     * @param int $id
     * @return TaskStatus
     */
    public function getStatusById(int $id): TaskStatus
    {
        return TaskStatus::findOrFail($id);
    }

    /**
     * @param array $data
     * @param TaskStatus $status
     */
    public function update(array $data, TaskStatus $status): void
    {
        $status->fill($data);
        $status->save();
    }

    /**
     * @param TaskStatus $status
     * @return int|mixed|void
     */
    public function delete(TaskStatus $status)
    {
        try {
            $status->delete();
        } catch (\Exception $exception) {
            return $exception->getCode();
        }
    }
}
