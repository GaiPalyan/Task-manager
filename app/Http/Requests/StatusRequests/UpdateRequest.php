<?php

namespace App\Http\Requests\StatusRequests;

use App\Http\Requests\BaseRequest;
use App\Models\TaskStatus;

class UpdateRequest extends BaseRequest
{
    private array $rules = ['name' => ['unique:' . TaskStatus::class]];

    public function rules(array $rules = []): array
    {
        return parent::rules($this->rules);
    }

    public function messages(): array
    {
        $messageBag = parent::messages();
        $messageBag['unique'] = 'Статус с таким именем уже существует';
        return $messageBag;
    }
}
