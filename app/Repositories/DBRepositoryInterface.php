<?php

namespace App\Repositories;

interface DBRepositoryInterface
{
    public function getList(): array;
    public function store(array $subject, int $creatorId): void;
    public function getItemById(int $id): array;
    public function update(array $data, int $id): void;
    public function delete(int $id);
}