<?php

namespace Laradic\Support\Spatie\CollectionMacros\Macros;

class Tenth
{
    public function __invoke()
    {
        return function () {
            return $this->get(9);
        };
    }
}
