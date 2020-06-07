<?php

namespace Laradic\Support\Traits;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Arrayable;

trait ArrayableProperties
{
//    protected $arrayableProperties;

    protected function getArrayablePropertiesProperty()
    {
        return 'arrayable';
    }

    protected function getUnarrayablePropertiesProperty()
    {
        return 'unarrayable';
    }

    protected function getArrayablePropertyKeys()
    {
        $class = get_class($this);

        $property   = $this->getArrayablePropertiesProperty();
        $properties = null;
        if (property_exists($this, $property)) {
            $properties = $this->{$property};
        }
        if ($properties === null || (is_array($properties) && $properties === [ '*' ])) {
            $properties = 'get_class_vars';
        }
        if (is_string($properties)) {
            if ($properties === 'get_class_vars') {
                $properties = array_keys(get_class_vars(get_class($this)));
            } elseif (method_exists($this, $properties)) {
                $properties = $this->$properties();
            }
        } elseif ($properties instanceof Closure) {
            $properties = $properties->call($this);
        }

        return Arr::wrap($properties);
    }

    protected function getUnarrayablePropertyKeys()
    {
        $property   = $this->getUnarrayablePropertiesProperty();
        $properties = [];
        if (property_exists($this, $property)) {
            $properties = $this->{$property};
        }
        $properties[] = 'unarrayable';
        $properties[] = 'arrayable';
        return $properties;
    }

    protected function addArrayableProperty($name)
    {
        $propertyName = $this->getArrayablePropertiesProperty();
        if ( ! in_array($name, $this->{$propertyName}, true)) {
            $this->{$propertyName}[] = $name;
        }
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
        $result      = [];
        $unarrayable = $this->getUnarrayablePropertyKeys();
        foreach ($this->getArrayablePropertyKeys() as $key) {
            // try accessing the property via a getter method
            if (in_array($key, $unarrayable, true)) {
                continue;
            }
            try {
                $methodName = Str::camel('get_' . $key);
                if (method_exists($this, $methodName)) {
                    $value = $this->{$methodName}();
                } else {
                    $value = $this->{$key};
                }

                if (
                    $value instanceof Arrayable === false
                    && Arr::accessible($value)
                    && ! Arr::isAssoc($value)
                ) {
                    $value = Collection::wrap($value)->toArray();
                }
                if( $value instanceof Arrayable){
                    $value= $value->toArray();
                }
                $result[ $key ] = $value;
            }
            catch (\ErrorException $e) {
            }
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