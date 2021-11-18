<?php

declare(strict_types=1);

namespace App\Domain;

use App\Http\Requests\TaskRequests\TaskRequestData;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

class TaskManager
{
    private TaskRepositoryInterface $taskRepository;
    private StatusRepositoryInterface $statusRepository;
    private LabelRepositoryInterface $labelRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        StatusRepositoryInterface $statusRepository,
        LabelRepositoryInterface $labelRepository,
    ) {
        $this->statusRepository = $statusRepository;
        $this->taskRepository = $taskRepository;
        $this->labelRepository = $labelRepository;
    }

    public function getFilterOptions(): array
    {
        $creators = $this->taskRepository->getCreators();
        $performers = $this->taskRepository->getAssignedPerformers();
        $statuses = $this->statusRepository->getFormOptions();
        return compact('creators', 'performers', 'statuses');
    }

    public function getOptions(): array
    {
        $labels = $this->labelRepository->getFormOptions();
        $statuses = $this->statusRepository->getFormOptions();
        $performers = $this->taskRepository->getAvailablePerformers();

        return compact('labels', 'statuses', 'performers');
    }

    public function getTaskRelatedData(Task $task): array
    {
        $taskStatus = $this->taskRepository->getRelatedData($task, TaskStatus::class);
        $taskLabels = $this->taskRepository->getRelatedData($task, Label::class);
        $taskPerformer = $this->taskRepository->getRelatedData($task, User::class);

        return compact('taskStatus', 'taskLabels', 'taskPerformer', 'task');
    }

    public function getTaskList(): array
    {
        $tasksList = $this->taskRepository->getList();
        return compact('tasksList');
    }

    public function saveTask(TaskRequestData $requestData, User $creator): void
    {
        $status = $this->statusRepository->getStatus($requestData->getTaskStatusId());
        $this->taskRepository->store($creator, $requestData->toArray(), $status);
    }

    public function updateTask(TaskRequestData $requestData, Task $task): void
    {
        $this->taskRepository->update($requestData->toArray(), $task);
    }

    public function deleteTask(Task $task): void
    {
        $this->taskRepository->delete($task);
    }
}
