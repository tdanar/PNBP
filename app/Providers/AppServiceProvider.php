<?php

namespace App\Providers;

use App\Http\Controllers\homepageController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
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
