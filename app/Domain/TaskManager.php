<?php

namespace App\Domain;

use App\Repositories\Status\StatusRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;

class TaskManager
{
    public TaskRepositoryInterface $taskRepository;
    public StatusRepositoryInterface $statusRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        StatusRepositoryInterface $statusRepository
    )
    {
        $this->statusRepository = $statusRepository;
        $this->taskRepository = $taskRepository;
    }

    public function getUniqueStatuses()
    {
        return $this->statusRepository->getUniqueNamedList();
    }

    public function getTaskList()
    {
       // return $this->taskRepository->getList();
    }

    public function saveTask(array $data, int $creatorId)
    {
        $status = $this->statusRepository->getStatusById($data['status_id']);
        $this->taskRepository->store($creatorId, $data, $status['status']);
    }

}