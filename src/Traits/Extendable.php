<?php
/**
 * Part of the Docit PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Support\Traits;

use BadMethodCallException;
use Closure;
use Illuminate\Contracts\Container\Container;
use Laradic\Support\Str;

/**
 * This is the class Extendable.
 *
 * @package        Laradic\Support
 * @author         Docit
 * @copyright      Copyright (c) 2015, Docit. All rights reserved
 */
trait Extendable
{
    /**
     * getContainer method
     *
     * @return Container
     */
    abstract public function getContainer();

    protected static $extensions = [ ];

    protected static $components = [ ];

    protected $componentInstances = [ ];

    public static function extensions()
    {
        return array_keys(static::$extensions);
    }

    public static function extend($name, $extension)
    {
        if (is_string($extension) && !Str::contains($extension, '@')) {
            static::$components[ $name ] = $extension;
        } else {
            static::$extensions[ $name ] = $extension;
        }
    }

    /**
     * callExtension method
     *
     * @private
     *
     * @param $name
     * @param $parameters
     *
     * @return mixed
     */
    protected function callExtension($name, $parameters)
    {
        $callback = static::$extensions[ $name ];

        if ($callback instanceof Closure) {
            return call_user_func_array($callback->bindTo($this, get_class($this)), $parameters);
        } elseif (is_string($callback) && Str::contains($callback, '@')) {
            return $this->callClassBasedExtension($callback, $parameters);
        }
    }


    /**
     * callClassBasedExtension method
     *
     * @private
     * @param $callback
     * @param $parameters
     *
     * @return mixed
     */
    private function callClassBasedExtension($callback, $parameters)
    {
        list($class, $method) = explode('@', $callback);
        $instance = $this->getContainer()->make($class, [
            'parent' => $this
        ]);

        return call_user_func_array([ $instance, $method ], $parameters);
    }

    /**
     * getClassInstanceExtension method
     *
     * @param $name
     * @private
     *
     * @return mixed
     */
    private function getClassInstanceExtension($name)
    {
        $extension = static::$components[ $name ];

        if (is_string($extension) && class_exists($extension)) {
            if (!array_key_exists($name, $this->componentInstances)) {
                $this->componentInstances[ $name ] = $this->getContainer()->make($extension, [
                    'parent' => $this
                ]);
            }

            return $this->componentInstances[ $name ];
        }
    }

    public function __call($name, array $params = [ ])
    {
        if (array_key_exists($name, static::$extensions)) {
            return $this->callExtension($name, $params);
        }
        throw new BadMethodCallException("Method [$name] does not exist.");
    }

    public function __get($name)
    {
        if (array_key_exists($name, static::$components)) {
            return $this->getClassInstanceExtension($name);
        }
    }
}
