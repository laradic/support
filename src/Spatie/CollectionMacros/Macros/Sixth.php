<?php

namespace Laradic\Support\Spatie\CollectionMacros\Macros;

class Sixth
{
    public function __invoke()
    {
        return function () {
            return $this->get(5);
        };
    }
}
