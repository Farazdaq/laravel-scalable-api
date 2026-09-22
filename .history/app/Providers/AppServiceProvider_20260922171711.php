<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Interfaces\EmailRepositoryInterface;
use App\Infrastructure\Persistence\Repositories\EmailRepository;
use App\Domain\Interfaces\CacheInterface;
use App\Infrastructure\Cache\LaravelCache;
use App\Domain\Interfaces\NotificationRepositoryInterface;
use App\Infrastructure\Persistence\Repositories\NotificationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            EmailRepositoryInterface::class,
            EmailRepository::class
        );
        $this->app->bind(
            CacheInterface::class,
            LaravelCache::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
