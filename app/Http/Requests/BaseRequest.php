<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    private array $rules = ['name' => ['required']];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    private function setRules(array $additionalRules): void
    {
        foreach ($additionalRules as $attribute => $rule) {
            $this->rules[$attribute] = array_key_exists($attribute, $this->rules)
                ? array_unique(array_merge($this->rules[$attribute], $rule))
                : $this->rules[$attribute] = $rule;
        }
    }

    public function rules(array $additionalRules = []): array
    {
        if (!empty($additionalRules)) {
            $this->setRules($additionalRules);
        }
        return $this->rules;
    }
}
