<?php

namespace Laradic\Support\Macros\Collection;

class DataGet
{
    public function __invoke()
    {
        return function ($key, $default=null) {
            return data_get($this->items, $key, $default);
        };
    }
}

