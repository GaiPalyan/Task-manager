<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Exception;

/**
 * @throws Exception
 */
function make($subject)
{
    return match ($subject) {
        User::class => User::factory(),
        TaskStatus::class => TaskStatus::factory(),
        Task::class => Task::factory(),
        Label::class => Label::factory(),
        default => throw new Exception('Wrong subject'),
    };
}

