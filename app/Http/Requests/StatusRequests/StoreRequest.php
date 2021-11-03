<?php

namespace App\Http\Requests\StatusRequests;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    protected array $statusCreateRules = [
        'name' => ['unique:App\Models\TaskStatus,name', 'required'],
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        foreach ($this->statusCreateRules as $name => $rule) {
            $this->baseRules[$name] = array_key_exists($name, $this->baseRules)
                ? array_unique(array_merge($this->baseRules[$name], $rule))
                : $this->baseRules[$name] = $rule;
        }

        return $this->baseRules;
    }

    public function messages()
    {
        $baseMessageBag = parent::messages();
        $baseMessageBag['unique'] = 'Статус с таким именем уже существует';
        return $baseMessageBag;
    }
}
