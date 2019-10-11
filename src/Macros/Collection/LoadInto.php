<?php

namespace Laradic\Support\Macros\Collection;

use Illuminate\Contracts\Container\Container;

class LoadInto
{
    public function __invoke()
    {
        return function ($target) {
            return new $target($this->all());
        };
    }
}
