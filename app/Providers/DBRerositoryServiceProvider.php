<?php

namespace App\Providers;

use App\Repositories\DBRepositoryInterface;
use App\Repositories\StatusRepository;
use Illuminate\Support\ServiceProvider;

class DBRerositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(DBRepositoryInterface::class, StatusRepository::class);
    }
}
