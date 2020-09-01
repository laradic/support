<?php

namespace Laradic\Support\Macros\Collection;

/**
 *
 */
class Call
{
    public function __invoke()
    {
        return function ($callable, $parameters = [], $addKeyToParameters = false) {
            return $this->map(function ($item, $key) use ($callable, $parameters, $addKeyToParameters) {
                $parameters[] = $item;
                if ($addKeyToParameters) {
                    $parameters[] = $key;
                }
                if (is_string($callable) && function_exists($callable)) {
                    return call_user_func_array($callable, $parameters);
                }
                return forward_static_call_array($callable, $parameters);
            });
        };
    }
}

