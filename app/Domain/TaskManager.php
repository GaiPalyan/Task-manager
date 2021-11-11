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
        $creators = $this->taskRepository->getUniqueTaskCreators();
        $performers = $this->taskRepository->getUniqueAssignedPerformers();
        $statuses = $this->statusRepository->getAll();
        return compact('creators', 'performers', 'statuses');
    }

    public function getCreatingOptions(): array
    {
        $labels = $this->labelRepository->getAll();
        $statuses = $this->statusRepository->getAll();
        $performers = $this->taskRepository->getPerformers();

        return compact('labels', 'statuses', 'performers');
    }

    public function getUpdatingOptions(Task $task): array
    {
        $labels = $this->labelRepository->getAll();
        $statuses = array_filter(
            $this->statusRepository->getAll(),
            static fn($status) => $status->id !== $task->status_id
        );
        $performers = array_filter(
            $this->taskRepository->getPerformers(),
            static fn($performer) => $performer->id !== $task->assigned_to_id
        );

        return compact('labels', 'statuses', 'performers');
    }

    public function getTaskRelatedData(Task $task): array
    {
        $taskStatus = head($this->taskRepository->getStatus($task));
        $taskLabels = $this->taskRepository->getTaskLabels($task);
        $taskPerformer = head($this->taskRepository->getTaskPerformer($task));
        return compact('taskStatus', 'taskLabels', 'taskPerformer');
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
