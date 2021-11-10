<?php

namespace App\Http\Requests\LabelRequests;

use App\Http\Requests\BaseRequest;
use App\Models\Label;

class StoreRequest extends BaseRequest
{
    private array $rules = ['name' => ['unique:' . Label::class]];

    public function rules(array $rules = []): array
    {
        return parent::rules($this->rules);
    }

    public function messages(): array
    {
        $messageBag = parent::messages();
        $messageBag['unique'] = 'Метка с таким именем уже существует';
        return $messageBag;
    }
}
