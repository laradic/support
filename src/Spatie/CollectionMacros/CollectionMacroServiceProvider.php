<?php

namespace Laradic\Support\Spatie\CollectionMacros;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionMacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        Collection::make(glob(__DIR__.'/Macros/*.php'))
            ->mapWithKeys(function ($path) {
                return [$path => pathinfo($path, PATHINFO_FILENAME)];
            })
            ->reject(function ($macro) {
                return Collection::hasMacro($macro);
            })
            ->each(function ($macro, $path) {
                $class = 'Laradic\\Support\\Spatie\\CollectionMacros\\Macros\\'.$macro;
                Collection::macro(Str::camel($macro), $this->app->make($class)());
            });
    }
}
