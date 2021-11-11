<?php

declare(strict_types=1);

namespace App\Domain;

use App\Models\Label;
use Illuminate\Pagination\LengthAwarePaginator;

interface LabelRepositoryInterface
{
    public function getList(): LengthAwarePaginator;
    public function store(array $data): void;
    public function update(array $data, Label $label): void;
    public function getAll(): array;
    public function delete(Label $label): void;
}
