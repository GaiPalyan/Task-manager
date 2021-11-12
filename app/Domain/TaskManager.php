<?php

declare(strict_types=1);

namespace App\Domain;

use App\Models\Task;
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
        $taskStatus = $this->taskRepository->getRelatedData($task, 'status');
        $taskLabels = $this->taskRepository->getRelatedData($task, 'labels');
        $taskPerformer = $this->taskRepository->getRelatedData($task, 'performer');

        return compact('taskStatus', 'taskLabels', 'taskPerformer', 'task');
    }

    public function getTaskList(): array
    {
        $tasksList = $this->taskRepository->getList();
        return compact('tasksList');
    }

    public function saveTask(array $inputData, User $creator): void
    {
        $status = $this->statusRepository->getStatusById((int) $inputData['status_id']);
        $this->taskRepository->store($creator, $inputData, $status);
    }

    public function updateTask(array $inputData, Task $task): void
    {
        $this->taskRepository->update($inputData, $task);
    }

    public function deleteTask(Task $task): void
    {
        $this->taskRepository->delete($task);
    }
}
