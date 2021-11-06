<?php

declare(strict_types=1);

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

    /**
     * @return array
     */
    public function getStatusList(): array
    {
        return $this->statusRepository->getList();
    }

    /**
     * @param int $id
     * @return TaskStatus
     */
    public function getStatus(int $id): TaskStatus
    {
        return $this->statusRepository->getStatusById($id);
    }

    /**
     * @param array $inputData
     */
    public function saveStatus(array $inputData): void
    {
        $this->statusRepository->store($inputData);
    }

    /**
     * @param array $inputData
     * @param TaskStatus $status
     */
    public function updateStatus(array $inputData, TaskStatus $status): void
    {
        $this->statusRepository->update($inputData, $status);
    }

    /**
     * @param TaskStatus $status
     */
    public function deleteStatus(TaskStatus $status): void
    {
        $this->statusRepository->delete($status);
    }

    /**
     * @param TaskStatus $status
     * @return bool
     */
    public function isAssociated(TaskStatus $status): bool
    {
        return $status->task()->exists();
    }
}
