<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @throws Exception
 */
function make(string $subject): Factory
{
    return match ($subject) {
        User::class => User::factory(),
        TaskStatus::class => TaskStatus::factory(),
        Task::class => Task::factory(),
        Label::class => Label::factory(),
        default => throw new Exception('Wrong subject'),
    };
}
