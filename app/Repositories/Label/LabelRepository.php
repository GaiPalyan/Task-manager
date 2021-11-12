<?php

declare(strict_types=1);

namespace App\Repositories\Label;

use App\Domain\LabelRepositoryInterface;
use App\Models\Label;
use Illuminate\Pagination\LengthAwarePaginator;

class LabelRepository implements LabelRepositoryInterface
{

    public function getList(): LengthAwarePaginator
    {
        return Label::select('*')->orderByDesc('created_at')->paginate(10);
    }

    public function getFormOptions(): array
    {
        return Label::pluck('name', 'id')->toArray();
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
