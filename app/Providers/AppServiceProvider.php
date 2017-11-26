<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Shape;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.adminlayout', function($view) {
            // $myvar = 'test';
            $view->with('data', array('shapes' => Shape::get()));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
