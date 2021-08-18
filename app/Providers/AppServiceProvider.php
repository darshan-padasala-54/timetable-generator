<?php

namespace App\Providers;

use App\Interfaces\EmiHistoryRepositoryInterface;
use App\Repository\EmiHistoryRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmiHistoryRepositoryInterface::class, EmiHistoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultstringLength(191);
    }
}
