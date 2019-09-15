<?php

namespace Laradic\Support\Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Transform a collection into an associative array form collection item.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class FromPairs
{
    public function __invoke()
    {
        return function (): Collection {
            return $this->reduce(function ($assoc, array $keyValuePair): Collection {
                list($key, $value) = $keyValuePair;
                $assoc[$key] = $value;

                return $assoc;
            }, new static);
        };
    }
}
