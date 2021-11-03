<?php

namespace App\Domain;

use App\Models\Label;
use App\Repositories\Label\LabelRepositoryInterface;

class LabelsManager
{
    private LabelRepositoryInterface $labelsRepository;

    public function __construct(LabelRepositoryInterface $labelsRepository)
    {
        $this->labelsRepository = $labelsRepository;
    }

    public function getLabels(): array
    {
        return $this->labelsRepository->getList();
    }

    public function saveLabel(array $data): void
    {
        $this->labelsRepository->store($data);
    }

    public function updateLabel(array $data, Label $label): void
    {
        $this->labelsRepository->update($data, $label);
    }

    public function deleteLabel(Label $label): void
    {
        $this->labelsRepository->delete($label);
    }

    public function isAttached(Label $label): bool
    {
        return $label->tasks()->exists();
    }

}