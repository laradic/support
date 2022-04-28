<?php

namespace Laradic\Support\Traits;

use Illuminate\Support\Facades\App;

trait CallableTrait
{
    public static function make(array $arguments = []): static
    {
        return App::make(static::class, $arguments);
    }

    public static function create(...$arguments): static
    {
        return new static(...$arguments);
    }

    public static function call(...$arguments)
    {
        $instance = new static(...$arguments);
        return App::call([ $instance, 'handle' ]);
    }

    public static function dispatch()
    {
        return static::make()->run();
    }

    public function run()
    {
        return App::call([ $this, 'handle' ]);
    }
}
