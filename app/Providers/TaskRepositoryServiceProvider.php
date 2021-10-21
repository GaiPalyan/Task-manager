<?php

namespace App\Providers;

use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class TaskRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }
}
