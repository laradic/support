<?php

namespace Laradic\Support\Macros\Collection;

use Laradic\Support\Wrap;

/**
 * Switch array wrapper from Collection to Dot
 */
class ToDot
{
    public function __invoke()
    {
        return function () {
            return Wrap::dot($this->all());
        };
    }
}
