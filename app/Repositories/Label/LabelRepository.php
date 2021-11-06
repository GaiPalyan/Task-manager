<?php

declare(strict_types=1);

namespace App\Repositories\Label;

use App\Models\Label;
use Illuminate\Support\Collection;

class LabelRepository implements LabelRepositoryInterface
{
    /**
     * @return array
     */
    public function getList(): array
    {
        $labels = Label::select('*')->orderByDesc('created_at')->paginate(10);
        return compact('labels');
    }

    /**
     * @return Collection
     */
    public function getUniqueNamedList(): Collection
    {
        return Label::distinct('name')->get();
    }

    /**
     * @param array $data
     */
    public function store(array $data): void
    {
        $label = new Label();
        $label->fill($data);
        $label->save();
    }

    /**
     * @param array $data
     * @param Label $label
     */
    public function update(array $data, Label $label): void
    {
        $label->fill($data);
        $label->save();
    }

    public function delete(Label $label): void
    {
        $label->delete();
    }
}