<?php

namespace App\Repositories;

use App\Models\TaskStatus;
use App\Models\User;

class StatusRepository implements DBRepositoryInterface
{
    public function getList(): array
    {
        $statuses = TaskStatus::statusesList()->paginate(10);
        return compact('statuses');
    }

    public function store(array $name, int $creatorId): void
    {
        $user = User::findOrFail($creatorId);
        $status = $user->statuses()->make($name);
        $status->save();
    }

    public function getItemById(int $id): array
    {
        $status = TaskStatus::findOrFail($id);
        return compact('status');
    }

    public function update(array $data, int $id): void
    {
        $status = TaskStatus::findOrFail($id);
        $status->fill($data);
        $status->save();
    }

    /**
     * @param int $id
     * @return int|mixed|void
     */
    public function delete(int $id)
    {
        $status = TaskStatus::findorFail($id);

        try {
            $status->delete();
        } catch (\Exception $exception) {
            return $exception->getCode();
        }
    }
}