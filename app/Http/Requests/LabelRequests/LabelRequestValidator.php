<?php

namespace App\Http\Requests\LabelRequests;

use App\Http\Requests\BaseRequestValidator;
use App\Models\Label;
use Illuminate\Support\Facades\Route;

final class LabelRequestValidator extends BaseRequestValidator
{
    private array $rules = ['name' => ['unique:' . Label::class]];

    public function rules(array $rules = []): array
    {
        if (Route::currentRouteName() === 'labels.update') {
            $updateRules = collect($this->rules)->except('name')->toArray();
            return parent::rules($updateRules);
        }
        return parent::rules($this->rules);
    }

    public function messages(): array
    {
        $messageBag = parent::messages();
        $messageBag['unique'] = 'Метка с таким именем уже существует';
        return $messageBag;
    }

    public function inputData(): LabelRequestData
    {
        return new LabelRequestData(
            $this->input('name'),
            $this->input('description'),
        );
    }
}
