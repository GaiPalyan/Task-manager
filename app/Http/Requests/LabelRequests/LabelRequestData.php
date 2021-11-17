<?php

namespace App\Http\Requests\LabelRequests;

class LabelRequestData
{
    private string $name;
    private string|null $description;

    public function __construct(string $name, string $description = null)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return  $this->description;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
