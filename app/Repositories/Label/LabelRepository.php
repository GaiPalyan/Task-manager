<?php

declare(strict_types=1);

namespace App\Repositories\Label;

use App\Models\Label;
use Illuminate\Support\Collection;

class LabelRepository implements LabelRepositoryInterface
{

    public function getList(): array
    {
        $labels = Label::select('*')->orderByDesc('created_at')->paginate(10);
        return compact('labels');
    }

    public function getUniqueNamedList(): Collection
    {
        return Label::distinct('name')->get();
    }

    public function store(array $data): void
    {
        $label = new Label();
        $label->fill($data);
        $label->save();
    }

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
