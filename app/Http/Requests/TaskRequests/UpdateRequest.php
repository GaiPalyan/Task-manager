<?php

declare(strict_types=1);

namespace App\Http\Requests\TaskRequests;

use App\Http\Requests\BaseRequest;

final class UpdateRequest extends BaseRequest
{
    private array $rules = [
        'status_id' => ['required'],
    ];

    public function rules(array $rules = []): array
    {
        return parent::rules($this->rules);
    }
}
