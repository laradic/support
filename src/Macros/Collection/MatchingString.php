<?php

namespace Laradic\Support\Macros\Collection;

use Illuminate\Support\Str;

class MatchingString
{
    public function __invoke()
    {
        return function ($pattern, bool $useKey = false) {
            $items = array_filter($this->items, static function ($value, $key) use ($pattern, $useKey) {
                return Str::is($pattern, (string)($useKey ? $key : $value));
            }, ARRAY_FILTER_USE_BOTH);
            return new static($items);
        };
    }
}

