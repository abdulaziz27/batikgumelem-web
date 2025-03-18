<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Share available languages with all views
        View::composer('*', function ($view) {
            $view->with('availableLanguages', Config::get('languages.available_languages'));
            $view->with('currentLocale', app()->getLocale());
        });
    }
}
