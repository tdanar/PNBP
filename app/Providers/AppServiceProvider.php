<?php

namespace App\Providers;

use Carbon\Carbon;
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
        setlocale(LC_ALL, 'id');
        Carbon::setLocale('id');
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
