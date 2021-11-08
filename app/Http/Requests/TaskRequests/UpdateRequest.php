<?php

declare(strict_types=1);

namespace App\Http\Requests\TaskRequests;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    protected array $taskUpdateRules = [
        'status_id' => ['required']
    ];

    public function rules(): array
    {
        foreach ($this->taskUpdateRules as $name => $rule) {
            $this->baseRules[$name] = array_key_exists($name, $this->baseRules)
                ? array_unique(array_merge($this->baseRules[$name], $rule))
                : $this->baseRules[$name] = $rule;
        }

        return $this->baseRules;
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        $baseMessageBag = parent::messages();
        $baseMessageBag['unique'] = 'Задача с таким именем уже существует';
        return $baseMessageBag;
    }
}
