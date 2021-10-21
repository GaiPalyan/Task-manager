<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    protected array $baseRules = ['name' => ['required']];

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
        return $this->baseRules;
    }

    public function messages()
    {
        return [
            'required' => 'Поле не может быть пустым',
        ];
    }
}
