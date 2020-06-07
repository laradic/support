<?php


namespace Laradic\Support\Concerns;


trait ForwardsCollection
{
    abstract protected function getCollectionPropertyName(): string;

    /** @return \Illuminate\Support\Collection */
    private function collection()
    {
        $property = $this->getCollectionPropertyName();
        return $this->{$property};
    }

    public function __call($method, $params)
    {
        if (method_exists($this->collection(), $method) || $this->collection()::hasMacro($method)) {
            return call_user_func_array([ $this->collection(), $method ], $params);
        }
    }

    public function __get($name)
    {
        return $this->collection()->get($name);
    }

    public function __set($name, $value)
    {
        return $this->collection()->put($name, $value);
    }

    public function __unset($name)
    {
        return $this->collection()->forget($name);
    }

    public function __isset($name)
    {
        return $this->collection()->has($name);
    }

    public function offsetExists($offset)
    {
        return $this->collection()->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->collection()->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        return $this->collection()->put($offset, $value);
    }

    public function offsetUnset($offset)
    {
        return $this->collection()->forget($offset);
    }
}
