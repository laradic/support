<?php

namespace Laradic\Support\Spatie\CollectionMacros\Macros;

class Second
{
    public function __invoke()
    {
        return function () {
            return $this->get(1);
        };
    }
}
