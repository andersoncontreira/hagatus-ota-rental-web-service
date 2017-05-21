<?php

namespace App\Providers;

use Hagatus\Ota\Http\Request\RequestParserService;
use Illuminate\Support\ServiceProvider;


/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RequestParserService::class, function($app) {
            return new RequestParserService();
        });


        //
//        $this->app->singleton(ParseService::class, function ($app) {
//            var_dump('registering');
//            //return new Connection(config('riak'));
//        });
//        $this->app->bind('Illuminate\Contracts\Filesystem\Factory', function($app) {
//            return new \Illuminate\Filesystem\FilesystemManager($app);
//        });
    }
}
