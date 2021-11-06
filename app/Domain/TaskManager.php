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

    /**
     * @return array
     */
    public function getFilterOptions(): array
    {
        $options = $this->taskRepository->getAvailableFilterOptions();
        $performers = $this->taskRepository->getAssignedPerformersList();

        return compact('options', 'performers');
    }

    /**
     * @return array
     */
    public function getCreatingOptions(): array
    {
        $labels = $this->labelRepository->getUniqueNamedList();
        $statuses = $this->statusRepository->getAll();
        $performers = $this->taskRepository->getAssignedPerformersList();

        return compact('labels', 'statuses', 'performers');
    }

    /**
     * @param Task $task
     * @return array
     */
    public function getUpdatingOptions(Task $task): array
    {
        $labels = $this->labelRepository->getUniqueNamedList();
        $statuses = $this->statusRepository->getAll()
                    ->reject(static fn($status) => $status->id === $task->status_id);
        $performers = $this->taskRepository->getAssignedPerformersList()
                    ->reject(static fn($performer) => $performer->performer_id === $task->assigned_to_id);

        return compact('labels', 'statuses', 'performers');
    }

    /**
     * @param Task $task
     * @return array
     */
    public function getTaskRelatedData(Task $task): array
    {
        $taskStatus = $this->taskRepository->getStatus($task);
        $taskLabels = $this->taskRepository->getTaskLabels($task);
        $taskPerformer = $this->taskRepository->getTaskPerformer($task);

        return compact('taskStatus', 'taskLabels', 'taskPerformer');
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getTaskList(): LengthAwarePaginator
    {
        return $this->taskRepository->getList();
    }

    /**
     * @param array $inputData
     * @param Authenticatable $creator
     */
    public function saveTask(array $inputData, Authenticatable $creator): void
    {
        $status = $this->statusRepository->getStatusById((int) $inputData['status_id']);
        $this->taskRepository->store($creator, $inputData, $status);
    }

    /**
     * @param array $inputData
     * @param Task $task
     */
    public function updateTask(array $inputData, Task $task): void
    {
        $this->taskRepository->update($inputData, $task);
    }

    /**
     * @param Task $task
     */
    public function deleteTask(Task $task): void
    {
        $this->taskRepository->delete($task);
    }
}
