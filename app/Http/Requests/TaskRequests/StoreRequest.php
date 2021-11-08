<?php

declare(strict_types=1);

namespace App\Http\Requests\TaskRequests;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    protected array $taskCreateRules = [
        'name' => ['unique:App\Models\Task,name', 'required'],
        'status_id' => ['required']
    ];

    public function rules(): array
    {
        foreach ($this->taskCreateRules as $attribute => $rule) {
            $this->baseRules[$attribute] = array_key_exists($attribute, $this->baseRules)
                ? array_unique(array_merge($this->baseRules[$attribute], $rule))
                : $this->baseRules[$attribute] = $rule;
        }

        return $this->baseRules;
    }

    public function messages(): array
    {
        $baseMessageBag = parent::messages();
        $baseMessageBag['unique'] = 'Задача с таким именем уже существует';
        return $baseMessageBag;
    }
}
