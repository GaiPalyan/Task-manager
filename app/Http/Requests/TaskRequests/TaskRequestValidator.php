<?php

declare(strict_types=1);

namespace App\Http\Requests\TaskRequests;

use App\Http\Requests\BaseRequestValidator;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

final class TaskRequestValidator extends BaseRequestValidator
{

    private array $rules = [
        'status_id' => ['required'],
        'name' => ['unique:' . Task::class]
    ];

    public function rules(array $rules = []): array
    {
        if (Route::currentRouteName() === 'tasks.update') {
            $updateRules = collect($this->rules)->except('name')->toArray();
            return parent::rules($updateRules);
        }
        return parent::rules($this->rules);
    }

    public function messages(): array
    {
        $baseMessageBag = parent::messages();
        $baseMessageBag['unique'] = 'Задача с таким именем уже существует';
        return $baseMessageBag;
    }

    public function inputData(): TaskRequestData
    {
        return new TaskRequestData(
            $this->input('name'),
            (int) $this->input('status_id'),
            $this->input('labels'),
            $this->input('description'),
            $this->input('assigned_to_id'),
        );
    }
}
