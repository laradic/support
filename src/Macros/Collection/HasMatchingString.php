<?php

namespace Laradic\Support\Macros\Collection;

class HasMatchingString
{
    public function __invoke()
    {
        return function ($pattern, bool $useKey = false) {
            return $this->matchingString($pattern, $useKey)->isNotEmpty();
        };
    }
}

