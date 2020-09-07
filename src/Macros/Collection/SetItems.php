<?php

namespace Laradic\Support\Macros\Collection;

/**
 * Clears the inner items or swaps it with a new array
 *
 * @return $this
 */
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

