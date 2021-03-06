<?php

namespace Laradic\Support;

use Laradic\Support\Commands\AddMixins;
use Illuminate\Support\ServiceProvider;
use Laradic\Support\Spatie\CollectionMacros\CollectionMacroServiceProvider;

class SupportServiceProvider extends ServiceProvider
{


    public function register()
    {
        $providers = [
            DevProvidersProvider::class,
            CollectionMacroServiceProvider::class,
        ];
        array_walk($providers, [ $this->app, 'register' ]);
        $this->mergeConfigFrom(__DIR__ . '/../config/laradic.support.php', 'laradic.support');
        $command = new AddMixins($this->app[ 'config' ][ 'laradic.support.mixins' ]);
        $this->app->call([ $command, 'handle' ]);
    }

    public function boot()
    {
        $this->publishes([ __DIR__ . '/../config/laradic.support.php' => config_path('laradic/support.php') ]);
    }
}
