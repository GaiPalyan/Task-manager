<?php

namespace App\Repositories\Status;

interface StatusRepositoryInterface
{
    public function getList(): array;
    public function getUniqueNamedList(): array;
    public function store(array $data, int $creatorId): void;
    public function getStatusById(int $id): array;
    public function update(array $data, int $id): void;
    public function delete(int $id);
}