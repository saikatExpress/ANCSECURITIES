<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\FundRepositoryInterface;
use App\Repositories\FundRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            FundRepositoryInterface::class,
            FundRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
