<?php

namespace Laradic\Support\Macros\Collection;

class Cast
{
    public function __invoke()
    {
        return function ($to) {
            return $this->map(function ($item) use ($to) {
                if ($to === 'string') {
                    return (string)$item;
                }
                if ($to === 'array') {
                    return (array)$item;
                }
                if ($to === 'object') {
                    return (object)$item;
                }
                if ($to === 'bool') {
                    return (bool)$item;
                }
                if ($to === 'int') {
                    return (int)$item;
                }
                return $item;
            });
        };
    }
}
