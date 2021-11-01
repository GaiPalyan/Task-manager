<?php

namespace App\Repositories\Label;

use App\Models\Label;

interface LabelRepositoryInterface
{
    public function getList(): array;
    public function store(array $data): void;
    public function update(array $data, Label $label): void;
    public function getUniqueNamedList(): array;
    public function delete(Label $label): void;
}