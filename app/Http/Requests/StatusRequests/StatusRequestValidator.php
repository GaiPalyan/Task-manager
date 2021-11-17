<?php

declare(strict_types=1);

namespace App\Http\Requests\StatusRequests;

use App\Http\Requests\BaseRequestValidator;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Route;

final class StatusRequestValidator extends BaseRequestValidator
{
    private array $rules = ['name' => ['unique:' . TaskStatus::class]];

    public function rules(array $rules = []): array
    {
        if (Route::currentRouteName() === 'task_statuses.update') {
            $updateRules = collect($this->rules)->except('name')->toArray();
            return parent::rules($updateRules);
        }
        return parent::rules($this->rules);
    }

    public function messages(): array
    {
        $messageBag = parent::messages();
        $messageBag['unique'] = 'Статус с таким именем уже существует';
        return $messageBag;
    }

    public function inputData(): StatusRequestData
    {
        return new StatusRequestData(
            $this->input('name')
        );
    }
}
