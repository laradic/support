<?php

namespace Laradic\Support;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Support\Arrayable;

class Dot extends \Adbar\Dot implements Arrayable
{
    use Macroable;

    public static function wrap($data = null)
    {
        return new static(Collection::wrap($data)->all());
    }

    public static function make($items = [])
    {
        return new static($items);
    }

    public static function reference(array &$items = [])
    {
        return static::make()->referenced($items);
    }

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
            $items = array_map($value, $items, $keys);
            $value = array_combine($keys, $items);
            $this->set($key, $value);
        }
        return $this;
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

    public function collect($key = null, $default = [])
    {
        return collect($key === null ? $this->items : $this->get($key, $default));
    }

    public function forget($keys)
    {
        Arr::forget($this->items, $keys);
        return $this;
    }

    public function toDotArray($prefix = '')
    {
        return Arr::dot($this->toArray(), $prefix);
    }

    public function contains($value, $path = null)
    {
        return $this->collect($path)->contains($value);
    }

    public function cut($values)
    {
        foreach ($this->items as $key => $value) {
            if (in_array($value, $values, true)) {
                unset($this->items[ $key ]);
            }
        }
        $this->items = array_values($this->items);
        return $values;
    }

    public function set($keys, $value = null)
    {
        parent::set($keys, $value);
        return $this;
    }
}
