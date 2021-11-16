<?php

declare(strict_types=1);

namespace App\Http\Requests\TaskRequests;

class TaskRequestData
{
    private string $name;
    private string|null $description;
    private int $statusId;
    private int|null $assignedId;
    private array $labels;

    public function __construct(
        string $name,
        int $statusId,
        array $labels,
        string $description = null,
        int $assignedToId = null
    ) {
        $this->name = $name;
        $this->statusId = $statusId;
        $this->labels = $labels;
        $this->description = $description;
        $this->assignedId = $assignedToId;
    }

    public function getTaskName(): string
    {
        return $this->name;
    }

    public function getTaskDescription(): string|null
    {
        return $this->description;
    }

    public function getTaskStatusId(): int
    {
        return $this->statusId;
    }

    public function getPerformerId(): int|null
    {
        return $this->assignedId;
    }

    public function getLabels(): array
    {
        return $this->labels;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'status_id' => $this->statusId,
            'assigned_to_id' => $this->assignedId,
            'labels' => $this->labels
        ];
    }
}
