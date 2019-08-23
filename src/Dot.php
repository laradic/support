<?php

namespace Laradic\Support;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Macroable;

class Dot extends \Adbar\Dot implements Arrayable
{
    use Macroable;

    public function toArray()
    {
        return $this->all();
    }

    public function map($key, $value = null)
    {
        if ($key instanceof Closure) {
            $keys        = array_keys($this->items);
            $items       = array_map($key, $this->items, $keys);
            $this->items = array_combine($keys, $items);
        } elseif (is_string($key)) {
            $items = (array)$this->get($key);
            $keys  = array_keys($items);
            $items = array_map($key, $this->items, $keys);
            $value = array_combine($keys, $items);
            $this->set($key, $value);
        }
    }

    public function referenced(array &$items = [])
    {
        $this->items = &$items;
        return $this;
    }
    public function dot($key = null)
    {
        return new static($key === null ? $this->items : $this->get($key, []));
    }

    public function collect($key = null)
    {
        return collect($key === null ? $this->items : $this->get($key, []));
    }

    public function forget($keys)
    {
        Arr::forget($this->items,  $keys);
        return $this;
    }

    public function toDotArray($prefix='')
    {
        return Arr::dot($this->toArray(), $prefix);
    }

}
