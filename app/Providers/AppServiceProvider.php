<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JobApis\Jobs\Client\JobsMulti;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
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
        $this->app->bind(JobsMulti::class, function () {
            return new JobsMulti(config('jobboards'));
        });
    }
}
