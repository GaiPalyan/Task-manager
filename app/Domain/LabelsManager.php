<?php

declare(strict_types=1);

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

    /**
     * @return array
     */
    public function getLabels(): array
    {
        return $this->labelsRepository->getList();
    }

    /**
     * @param array $inputData
     */
    public function saveLabel(array $inputData): void
    {
        $this->labelsRepository->store($inputData);
    }

    /**
     * @param array $inputData
     * @param Label $label
     */
    public function updateLabel(array $inputData, Label $label): void
    {
        $this->labelsRepository->update($inputData, $label);
    }

    /**
     * @param Label $label
     */
    public function deleteLabel(Label $label): void
    {
        $this->labelsRepository->delete($label);
    }

    /**
     * @param Label $label
     * @return bool
     */
    public function isAttached(Label $label): bool
    {
        return $label->tasks()->exists();
    }
}
