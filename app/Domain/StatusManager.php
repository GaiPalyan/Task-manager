<?php

namespace App\Domain;

use App\Repositories\Status\StatusRepositoryInterface;

class StatusManager
{
    private StatusRepositoryInterface $repository;

    public function __construct(StatusRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getStatusList()
    {
        return $this->repository->getList();
    }

    public function saveStatus(array $data, int $creatorId)
    {
       $this->repository->store($data, $creatorId);
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