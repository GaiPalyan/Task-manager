<?php

declare(strict_types=1);

namespace App\Http\Requests\TaskRequests;

class TaskRequestData
{
    private string $name;
    private string|null $description;
    private int $status_id;
    private string|null $assigned_to_id;
    private array|null $labels;

    public function __construct(
        string $name,
        int $status_id,
        array $labels = null,
        string $description = null,
        string $assigned_to_id = null
    ) {
        $this->name = $name;
        $this->status_id = $status_id;
        $this->labels = !is_null($labels) ? array_filter($labels, static fn($label) => $label) : $labels;
        $this->description = $description;
        $this->assigned_to_id = $assigned_to_id;
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
        return $this->status_id;
    }

    public function getPerformerId(): int|null
    {
        return $this->assigned_to_id;
    }

    public function getLabels(): array|null
    {
        return $this->labels;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
