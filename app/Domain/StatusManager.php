<?php

namespace App\Domain;

use App\Models\TaskStatus;
use App\Repositories\Status\StatusRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;

class StatusManager
{
    private StatusRepositoryInterface $statusRepository;

    public function __construct(StatusRepositoryInterface $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function getStatusList()
    {
        return $this->statusRepository->getList();
    }

    public function getStatus(int $id): TaskStatus
    {
        return $this->statusRepository->getStatusById($id);
    }

    public function saveStatus(array $data, Authenticatable $creator)
    {
       $this->statusRepository->store($data, $creator);
    }

    public function updateStatus(array $data, TaskStatus $status)
    {
        $this->statusRepository->update($data, $status);
    }

    public function deleteStatus(TaskStatus $status)
    {
        $this->statusRepository->delete($status);
    }

    public function isAssociated(TaskStatus $status): bool
    {
        return $status->task()->exists();
    }
}