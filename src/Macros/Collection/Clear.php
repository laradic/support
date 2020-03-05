<?php

namespace Laradic\Support\Macros\Collection;

class Clear
{
    public function __invoke()
    {
        return function ($items = []) {
            $this->items = $this->getArrayableItems($items);
            return $this;
        };
    }
}

