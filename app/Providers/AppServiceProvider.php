<?php

namespace App\Providers;

use App\Interfaces\EmiHistoryRepositoryInterface;
use App\Interfaces\TimeTableRepositoryInterface;
use App\Repository\EmiHistoryRepository;
use App\Repository\TimeTableRepository;
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
        $this->app->bind(TimeTableRepositoryInterface::class, TimeTableRepository::class);
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
