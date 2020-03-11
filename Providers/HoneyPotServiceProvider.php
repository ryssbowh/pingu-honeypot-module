<?php

namespace Pingu\HoneyPot\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Database\Eloquent\Factory;
use Pingu\Core\Support\ModuleServiceProvider;
use Pingu\HoneyPot\Http\Middleware\PreventsSpam;

class HoneyPotServiceProvider extends ModuleServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(Kernel $kernel)
    {
        $this->registerConfig();
        if(!$this->app->runningInConsole() and !\Auth::user()) {
            \Asset::container('modules')->add('honeypot-js', 'module-assets/Honeypot.js');
            $kernel->pushMiddleware(PreventsSpam::class);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if(!\Auth::user()) {
            $this->app->register(EventServiceProvider::class);
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'honeypot'
        );
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('honeypot.php')
        ], 'honeypot-config');
    }
}
