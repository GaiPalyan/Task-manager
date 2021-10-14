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

    public function saveStatus(array $status)
    {
       $this->repository->store($status);
    }

    public function getStatus(int $statusId): array
    {
        return $this->repository->getItemById($statusId);
    }

}