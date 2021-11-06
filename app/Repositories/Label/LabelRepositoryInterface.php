<?php

declare(strict_types=1);

namespace App\Repositories\Label;

use App\Models\Label;
use Illuminate\Support\Collection;

interface LabelRepositoryInterface
{
    public function getList(): array;
    public function store(array $data): void;
    public function update(array $data, Label $label): void;
    public function getUniqueNamedList(): Collection;
    public function delete(Label $label): void;
}