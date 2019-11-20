<?php

namespace Laradic\Support\Traits;

use Closure;
use Illuminate\Support\Arr;

trait ArrayableProperties
{
//    protected $arrayableProperties;

    protected function getArrayablePropertiesProperty()
    {
        return 'arrayable';
    }

    protected function getArrayableProperties()
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

    public function toArray()
    {
        $result = [];
        foreach ($this->getArrayableProperties() as $key) {
            $result[ $key ] = $this->{$key};
        }
        return $result;
    }
}