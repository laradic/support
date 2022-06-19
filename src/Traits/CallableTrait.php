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

    public static function toEventHandler(?array $properties = null)
    {
        return function($event) use ($properties){
            $properties = $properties ?: array_map(fn(\ReflectionProperty $property) => $property->getName(),(new \ReflectionClass($event))->getProperties(\ReflectionProperty::IS_PUBLIC));
            $parameters = [];
            foreach($properties as $name){
                $parameters[] = $event->{$name};
            }
            static::call($parameters);
        };
    }
}
