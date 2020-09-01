<?php

namespace Laradic\Support\Macros\Collection;

/**
 * Instead of regular get, use data_get to retreive something
 */
class DataGet
{
    public function __invoke()
    {
        return function ($key, $default = null) {
            return data_get($this->items, $key, $default);
        };
    }
}

