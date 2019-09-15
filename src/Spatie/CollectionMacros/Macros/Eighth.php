<?php

namespace Laradic\Support\Spatie\CollectionMacros\Macros;

class Eighth
{
    public function __invoke()
    {
        return function () {
            return $this->get(7);
        };
    }
}
