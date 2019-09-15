<?php

namespace Laradic\Support\Spatie\CollectionMacros\Macros;

class Fifth
{
    public function __invoke()
    {
        return function () {
            return $this->get(4);
        };
    }
}
