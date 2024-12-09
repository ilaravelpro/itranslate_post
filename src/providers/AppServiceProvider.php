<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/13/20, 6:07 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iTranslatePost\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if($this->app->runningInConsole())
        {
            if (itranslate_post('database.migrations.include', true))
                $this->loadMigrationsFrom(itranslate_post_path('database/migrations'));
        }
        $this->mergeConfigFrom(itranslate_post_path('config/itranslate_post.php'), 'ilaravel.main.itranslate_post');
    }

    public function register()
    {
        parent::register();
    }
}
