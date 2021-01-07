<?php

namespace Laradic\Support\Macros\Collection;

class DataSet
{
    public function __invoke()
    {
        return function ($key, $value, $overwrite = true) {
            data_set($this->items, $key, $value, $overwrite);
            return $this;
        };
    }
}

