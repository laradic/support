<?php

namespace Laradic\Support\Macros\Collection;

class PushTo
{
    public function __invoke()
    {
        return function (string $key, $value, bool $allowDuplicates = false) {
            /** @var \Illuminate\Support\Collection $this */
            if (is_array($this->items[ $key ])) {
                if ( ! \in_array($value, $this->items[ $key ], true) || $allowDuplicates) {
                    $this->items[ $key ][] = $value;
                }
            }
            return $this;
        };
    }
}
