<?php

namespace Laradic\Support\Macros\Collection;

use Illuminate\Support\Str;

class HasString
{
    public function __invoke()
    {
        return function ($string, bool $useKey = false) {
            $items = array_filter($this->items, static function ($value, $key) use ($string, $useKey) {
                $pattern = (string)($useKey ? $key : $value);
                return Str::is($pattern, $string);
            }, ARRAY_FILTER_USE_BOTH);
            return count($items) > 0;
        };
    }
}

