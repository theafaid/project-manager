<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Task;
use App\Observers\TaskObserver;
use App\Observers\ProjectObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        Project::observe(ProjectObserver::class);
        Task::observe(TaskObserver::class);
    }
}
