<?php

namespace App\Domain;

use App\Repositories\DBRepositoryInterface;

class StatusManager
{
    private DBRepositoryInterface $repository;

    public function __construct(DBRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getStatusList()
    {
        return $this->repository->getList();
    }

    public function saveStatus(array $status, int $creatorId)
    {
       $this->repository->store($status, $creatorId);
    }

    public function getStatus(int $statusId): array
    {
        return $this->repository->getItemById($statusId);
    }

    public function updateStatus(array $data, int $id)
    {
        $this->repository->update($data, $id);
    }

    public function deleteStatus(int $statusId)
    {
        $this->repository->delete($statusId);
    }
}