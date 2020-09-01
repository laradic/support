<?php

namespace Laradic\Support\Macros\Collection;

/**
 * Push a value into a underlying array at key
 *
 * @param string $key
 * @param mixed  $value
 * @param bool   $allowDuplicates
 */
class PushTo
{
    public function __invoke()
    {
        return function (string $key, $value, bool $allowDuplicates = false) {
            if (is_array($this->items[ $key ])) {
                if ( ! \in_array($value, $this->items[ $key ], true) || $allowDuplicates) {
                    $this->items[ $key ][] = $value;
                }
            }
            return $this;
        };
    }
}
