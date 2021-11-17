<?php

declare(strict_types=1);

namespace App\Http\Requests\StatusRequests;

class StatusRequestData
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getStatusName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
