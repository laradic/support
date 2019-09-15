<?php

namespace Laradic\Support\Spatie\CollectionMacros\Macros;

class Fourth
{
    public function __invoke()
    {
        return function () {
            return $this->get(3);
        };
    }
}
