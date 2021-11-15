<?php

declare(strict_types=1);

namespace App\Http\Requests\TaskRequests;

use Spatie\DataTransferObject\DataTransferObject;

class TaskRequestData extends DataTransferObject
{
    public string $name;
    public string|null $description;
    public int $status_id;
    public int|null $assigned_to_id;
    public array $labels;

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

    public function getLabels(): array
    {
        return $this->labels;
    }
}
