<?php

namespace App\Http\Requests\TaskRequests;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    protected $taskUpdateRules = [
        'status_id' => ['required']
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
        foreach ($this->taskUpdateRules as $name => $rule) {
            $this->baseRules[$name] = array_key_exists($name, $this->baseRules)
                ? array_unique(array_merge($this->baseRules[$name], $rule))
                : $this->baseRules[$name] = $rule;
        }

        return $this->baseRules;
    }

    public function messages()
    {
        $baseMessageBag = parent::messages();
        $baseMessageBag['unique'] = 'Задача с таким именем уже существует';
        return $baseMessageBag;
    }
}
