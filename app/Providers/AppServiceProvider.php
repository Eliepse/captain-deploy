<?php

namespace App\Providers;

use Eliepse\Deployer\Deployer;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('hash', \Illuminate\Hashing\HashManager::class);
        $this->app->alias('hash.driver', \Illuminate\Contracts\Hashing\Hasher::class);
    }
}
