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
        // dd(auth()->user());
        // if(Auth::check()){
        //     // dd('a');
        //     view()->composer('layouts.adminlayout', function($view) {
        //         // $myvar = 'test';
        //         $view->with('data', array('shapes' => Shape::where('user_id', Auth::id())->get()));
        //         dd($view);
        //     });
        // }
        

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
