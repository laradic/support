<?php

namespace Laradic\Support\Macros\Collection;

use Closure;
use Illuminate\Container\Container;

/**
 * Casts all the items to another type
 *
 * @param string|\Closure $to
 * @return $this
 */
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
                if (class_exists($to)) {
                    return new $to($item);
                }
                if ($to instanceof Closure) {
                    return Container::getInstance()->call($to, [ $item ]);
                }
                return $item;
            });
        };
    }
}
