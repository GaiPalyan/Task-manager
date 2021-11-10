<?php

declare(strict_types=1);

namespace App\Http\Requests\StatusRequests;

use App\Http\Requests\BaseRequest;
use App\Models\TaskStatus;

class StoreRequest extends BaseRequest
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
