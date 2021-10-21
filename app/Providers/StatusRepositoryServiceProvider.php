<?php

namespace App\Providers;

use App\Repositories\Status\StatusRepository;
use App\Repositories\Status\StatusRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class StatusRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(StatusRepositoryInterface::class, StatusRepository::class);
    }
}
