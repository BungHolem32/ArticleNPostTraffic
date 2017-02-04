<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 03/02/17
 * Time: 20:23
 */

namespace App\Providers;


use App\Http\Service\Helpers;
use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
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
        $this->app->singleton(Helpers::class, function ($app) {
            return new Helpers();
        });
    }
}