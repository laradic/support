<?php

namespace Laradic\Support\Spatie\CollectionMacros\Macros;

class Ninth
{
    public function __invoke()
    {
        return function () {
            return $this->get(8);
        };
    }
}
