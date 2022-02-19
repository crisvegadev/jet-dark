<?php

namespace Crisvegadev\JetDark;

use Crisvegadev\JetDark\Commands\JetDarkInstall;
use Illuminate\Support\ServiceProvider;

class JetDarkServiceProvider extends  ServiceProvider {

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/package-name.php' => config_path('package-name.php'),
            ], 'jet-dark');

            $this->commands([
                JetDarkInstall::class,
            ]);
        }


    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/jet-dark.php', 'jet-dark');

        // Register the main class to use with the facade
        $this->app->singleton('jet-dark', function () {
            return new JetDark;
        });
    }
}
