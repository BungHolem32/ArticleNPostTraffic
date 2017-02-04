<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02/02/17
 * Time: 20:33
 */

namespace App\Providers;

use App\Http\Service\Curl;
use Illuminate\Support\ServiceProvider;

class CurlServiceProvider extends ServiceProvider
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
        $this->app->singleton(Curl::class, function ($app) {
            return new Curl();
        });
    }
}