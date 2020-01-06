<?php

namespace Laradic\Support\Traits;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait ArrayableProperties
{
//    protected $arrayableProperties;

    protected function getArrayablePropertiesProperty()
    {
        return 'arrayable';
    }

    protected function getArrayablePropertyKeys()
    {
        $property   = $this->getArrayablePropertiesProperty();
        $properties = $this->{$property};
        if ($properties === null) {
            $properties = 'get_class_vars';
        }
        if (is_string($properties)) {
            if ($properties === 'get_class_vars') {
                $properties = array_keys(get_class_vars(get_class($this)));
            }
            if (method_exists($this, $properties)) {
                $properties = $this->$properties();
            }
        } elseif ($properties instanceof Closure) {
            $properties = $properties->call($this);
        }
        return Arr::wrap($properties);
    }

    protected function addArrayableProperty($name)
    {
        $property            = $this->getArrayablePropertiesProperty();
        $this->{$property}[] = $name;
        return $this;
    }

    /** @noinspection CallableInLoopTerminationConditionInspection */
    protected function forgetArrayableProperty($name)
    {
        $property = $this->getArrayablePropertiesProperty();
        Arr::forget($this->{$property}, $name);
        return $this;
    }

    protected function getArrayablePropertiesArray(?array $merge = null)
    {
        $result = [];
        foreach ($this->getArrayablePropertyKeys() as $key) {
            $value = $this->{$key};
            if (Arr::accessible($value)) {
                $value = Collection::wrap($value)->toArray();
            }
            $result[ $key ] = $value;
        }
        if ($merge) {
            $result = array_merge($result, $merge);
        }
        return $result;
    }

    public function toArray()
    {
        return $this->getArrayablePropertiesArray();
    }
}