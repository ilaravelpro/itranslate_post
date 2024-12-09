<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/13/20, 8:06 AM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslatePost\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    public function register()
    {
        parent::register();
    }

    public function map(Router $router)
    {
        if (itranslate_post('routes.api.status', true)) $this->apiRoutes($router);
    }

    public function apiRoutes(Router $router)
    {
        $router->group([
            'namespace' => '\iLaravel\iTranslatePost\iApp\Http\Controllers\API',
            'prefix' => 'api',
            'middleware' => 'api'
        ], function ($router) {
            require_once(itranslate_post_path('routes/api.php'));
        });
    }
}
