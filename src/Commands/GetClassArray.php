<?php

namespace Laradic\Support\Commands;

use ReflectionClass;
use ReflectionMethod;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class GetClassArray
{
    /** @var object */
    protected $instance;

    /**
     * @var array
     */
    protected $options;

    /**
     * GetClassArray constructor.
     *
     * @param object $instance
     */
    public function __construct($instance, array $options = [])
    {
        $this->instance = $instance;
        $this->options  = $options;
    }

    public function handle()
    {
        $data    = [];
        $class   = new ReflectionClass(get_class($this->instance));
        $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $method) {
            $methodName = $method->getName();
            if (in_array($methodName, Arr::get($this->options, 'exclude', []), true)) {
                continue;
            }
            if (Str::startsWith($methodName, [ 'get', 'is' ])) {
                $name = preg_replace('/^(get|is)/', '', $methodName);
                $name = Str::camel($name);
                try {
                    $value         = call_user_func([ $this->instance, $methodName ]);
                    $data[ $name ] = $value;
                }
                catch (\Throwable $e) {
                    if (Arr::get($this->options, 'ignoreExceptions', false) !== true) {
                        throw $e;
                    }
                }
            }
        }
        return $data;
    }
}
