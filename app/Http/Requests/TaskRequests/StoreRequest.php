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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        foreach ($this->taskCreateRules as $name => $rule) {
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
