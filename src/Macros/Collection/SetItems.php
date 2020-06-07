<?php

namespace Laradic\Support\Macros\Collection;

class SetItems
{
    public function __invoke()
    {
        return function ($items = []) {
            $this->items = $this->getArrayableItems($items);
            return $this;
        };
    }
}

