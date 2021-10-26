<?php

namespace App\Repositories\Status;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class StatusRepository implements StatusRepositoryInterface
{
    public function getList(): array
    {
        $statuses = TaskStatus::select('id', 'name', 'created_at')->orderByDesc('created_at')->paginate(10);
        return compact('statuses');
    }

    public function getUniqueNamedList(): array
    {
        $statuses = TaskStatus::distinct('name')->get();
        return compact('statuses');
    }

    public function store(array $name, Authenticatable $creator): void
    {
        $user = User::findOrFail($creator->getAuthIdentifier());
        $status = $user->statuses()->make($name);
        $status->save();
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