<?php

declare(strict_types=1);

namespace App\Http\Requests\StatusRequests;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    protected array $statusCreateRules = [
        'name' => ['unique:App\Models\TaskStatus,name', 'required'],
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        foreach ($this->statusCreateRules as $name => $rule) {
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
        $baseMessageBag['unique'] = 'Статус с таким именем уже существует';
        return $baseMessageBag;
    }
}
