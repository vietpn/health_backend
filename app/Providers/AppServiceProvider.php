<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $models = array(
            'Profile',
            'Message',
        );

        foreach ($models as $model) {
            $this->app->bind("App\Repositories\Api\\{$model}Repository", "App\Repositories\Api\\{$model}RepositoryEloquent");
        }
    }
}
