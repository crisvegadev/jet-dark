<?php

namespace Crisvegadev\JetDark;

use Crisvegadev\JetDark\Commands\JetDarkInstall;
use Illuminate\Support\ServiceProvider;

class JetDarkServiceProvider extends  ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                JetDarkInstall::class,
            ]);
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/jet-dark.php', 'jet-dark');
    }
}
