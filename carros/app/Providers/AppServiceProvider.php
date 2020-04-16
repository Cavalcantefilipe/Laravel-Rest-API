<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Repositories\Marca\MarcaRepositoryInterface',
            'App\Repositories\Marca\MarcaRepositoryEloquent'
        );

        $this->app->bind(
            'App\Repositories\Carro\CarroRepositoryInterface',
            'App\Repositories\Carro\CarroRepositoryEloquent'
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
