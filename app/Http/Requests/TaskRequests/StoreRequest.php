<?php

declare(strict_types=1);

namespace App\Http\Requests\TaskRequests;

use App\Http\Requests\BaseRequest;
use App\Models\Task;

final class StoreRequest extends BaseRequest
{

    private array $rules = [
        'status_id' => ['required'],
        'name' => ['unique:' . Task::class]
    ];

    public function rules(array $rules = []): array
    {
        return parent::rules($this->rules);
    }

    public function messages(): array
    {
        $baseMessageBag = parent::messages();
        $baseMessageBag['unique'] = 'Задача с таким именем уже существует';
        return $baseMessageBag;
    }

    public function inputData()
    {
        return new TaskRequestData([
            'name' => (string) $this->input('name'),
            'description' => (string) $this->input('description') ?: null,
            'status_id' => (int) $this->input('status_id'),
            'assigned_to_id' => (int) $this->input('assigned_to_id') ?: null,
            'labels' => (array) $this->input('labels'),
        ]);
    }
}
