<?php

declare(strict_types=1);

namespace App\Http\Requests\StatusRequests;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    protected array $statusCreateRules = [
        'name' => ['unique:App\Models\TaskStatus,name', 'required'],
    ];

    public function rules(): array
    {
        foreach ($this->statusCreateRules as $attribute => $rule) {
            $this->baseRules[$attribute] = array_key_exists($attribute, $this->baseRules)
                ? array_unique(array_merge($this->baseRules[$attribute], $rule))
                : $this->baseRules[$attribute] = $rule;
        }

        return $this->baseRules;
    }

    public function messages(): array
    {
        $baseMessageBag = parent::messages();
        $baseMessageBag['unique'] = 'Статус с таким именем уже существует';
        return $baseMessageBag;
    }
}
