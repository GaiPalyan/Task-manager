<?php

declare(strict_types=1);

namespace App\Domain;

use App\Models\Task;
use App\Repositories\Label\LabelRepositoryInterface;
use App\Repositories\Status\StatusRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;

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
        $options = $this->taskRepository->getAvailableFilterOptions();
        $performers = $this->taskRepository->getAssignedPerformersList();

        return compact('options', 'performers');
    }

    public function getCreatingOptions(): array
    {
        $labels = $this->labelRepository->getUniqueNamedList();
        $statuses = $this->statusRepository->getAll();
        $performers = $this->taskRepository->getAssignedPerformersList();

        return compact('labels', 'statuses', 'performers');
    }

    public function getUpdatingOptions(Task $task): array
    {
        $labels = $this->labelRepository->getUniqueNamedList();
        $statuses = $this->statusRepository->getAll()
                    ->reject(static fn($status) => $status->id === $task->status_id);
        $performers = $this->taskRepository->getAssignedPerformersList()
                    ->reject(static fn($performer) => $performer->performer_id === $task->assigned_to_id);

        return compact('labels', 'statuses', 'performers');
    }

    public function getTaskRelatedData(Task $task): array
    {
        $taskStatus = $this->taskRepository->getStatus($task);
        $taskLabels = $this->taskRepository->getTaskLabels($task);
        $taskPerformer = $this->taskRepository->getTaskPerformer($task);

        return compact('taskStatus', 'taskLabels', 'taskPerformer');
    }

    public function getTaskList(): LengthAwarePaginator
    {
        return $this->taskRepository->getList();
    }

    public function saveTask(array $inputData, Authenticatable $creator): void
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
