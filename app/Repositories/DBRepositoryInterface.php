<?php

namespace App\Repositories;

interface DBRepositoryInterface
{
    public function getList(): array;
    public function store(array $subject): void;
    public function getItemById(int $id): array;
}