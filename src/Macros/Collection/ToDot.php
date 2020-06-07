<?php

namespace Laradic\Support\Macros\Collection;

use Laradic\Support\Wrap;

class ToDot
{
    public function __invoke()
    {
        return function () {
            return Wrap::dot($this->all());
        };
    }
}
