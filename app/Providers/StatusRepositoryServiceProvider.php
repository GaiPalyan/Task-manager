<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\StatusRepositoryInterface;
use App\Repositories\Status\StatusRepository;
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
    public function boot(): void
    {
        $this->app->bind(StatusRepositoryInterface::class, StatusRepository::class);
    }
}
