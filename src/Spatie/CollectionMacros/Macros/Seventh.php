<?php

namespace Laradic\Support\Spatie\CollectionMacros\Macros;

class Seventh
{
    public function __invoke()
    {
        return function () {
            return $this->get(6);
        };
    }
}
