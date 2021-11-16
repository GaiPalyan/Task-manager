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

    public function inputData(): TaskRequestData
    {
        return new TaskRequestData(
            (string) $this->input('name'),
            (int) $this->input('status_id'),
            (array) $this->input('labels'),
            (string) $this->input('description') ?: null,
            (int) $this->input('assigned_to_id') ?: null,
        );
    }
}
