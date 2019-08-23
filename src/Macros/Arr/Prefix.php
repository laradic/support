<?php

namespace Laradic\Support\Macros\Arr;

class Prefix
{

    public function __invoke()
    {
        return function ($prefix, $items) {
            return array_map(function ($item) use ($prefix) {
                return $prefix . $item;
            }, $items);
        };
    }

}
