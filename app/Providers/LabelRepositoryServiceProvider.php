<?php

namespace App\Providers;

use App\Repositories\Label\LabelRepository;
use App\Repositories\Label\LabelRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class LabelRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(LabelRepositoryInterface::class, LabelRepository::class);
    }
}
