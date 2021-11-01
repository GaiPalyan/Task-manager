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

    public function saveLabel(array $data)
    {
        $this->labelsRepository->store($data);
    }

    public function updateLabel(array $data, Label $label)
    {
        $this->labelsRepository->update($data, $label);
    }

    public function deleteLabel(Label $label)
    {
        $this->labelsRepository->delete($label);
    }

    public function isAttached(Label $label)
    {
        return $label->tasks()->exists();
    }

}