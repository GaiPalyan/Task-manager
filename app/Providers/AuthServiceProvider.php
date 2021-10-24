<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('status-delete', function (User $user, TaskStatus $status) {
            return $user->getAuthIdentifier() === $status->getAttribute('user_id');
        });

        Gate::define('task-delete', function (User $user, Task $task) {
            return $user->getAuthIdentifier() === $task->getAttribute('created_by_id');
        });
    }
}
