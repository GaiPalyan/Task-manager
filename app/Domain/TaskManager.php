<?php

namespace App\Domain;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Repositories\Status\StatusRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;

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

    public function getUniqueStatuses(): array
    {
        return $this->statusRepository->getUniqueNamedList();
    }

    public function getTaskStatus(Task $task): TaskStatus
    {
        return $this->statusRepository->getStatusById($task->status_id);
    }

    public function getTaskList(): array
    {
        return $this->taskRepository->getList();
    }

    public function saveTask(array $data, Authenticatable $creator): void
    {
        $status = $this->statusRepository->getStatusById($data['status_id']);
        $this->taskRepository->store($creator, $data, $status);
    }

    public function updateTask(array $data, Task $task): void
    {
       $this->taskRepository->update($data, $task);
    }

    public function deleteTask(Task $task): void
    {
        $this->taskRepository->delete($task);
    }
}