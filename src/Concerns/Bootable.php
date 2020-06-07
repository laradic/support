<?php
/**
 * Part of the Laradic PHP packages.
 * License and copyright information bundled with this package in the LICENSE file
 */

namespace Laradic\Support\Concerns;

trait Bootable
{
    private static $traitInitializers = [];

    private static $booted = false;

    private $initialized = false;


    /**
     * Check if the model needs to be booted and if so, do it.
     */
    protected function bootIfNotBooted()
    {
        $class = get_class($this);

        if ( ! static::$booted) {
            static::$booted = true;
            //$this->fireEvent('booting', false);
            self::boot();
            //$this->fireEvent('booted', false);
        }
        if ( ! $this->initialized) {
            $this->initialized = true;
            $this->initialize();
        }
    }

    private function initialize()
    {
        foreach (static::$traitInitializers[ static::class ] as $method) {
            $this->{$method}();
        }
    }

    private static function boot()
    {
        $class                               = static::class;
        static::$traitInitializers[ $class ] = [];
        foreach (class_uses_recursive($class) as $trait) {
            $method = 'boot' . class_basename($trait);
            if (method_exists($class, $method)) {
                forward_static_call([ $class, $method ]);
            }
            if (method_exists($class, $method = 'initialize' . class_basename($trait))) {
                static::$traitInitializers[ $class ][] = $method;
                static::$traitInitializers[ $class ]   = array_unique(
                    static::$traitInitializers[ $class ]
                );
            }
        }
    }

    public static function clearStaticBooted()
    {
        static::$booted = [];
    }

    public function __wakeup()
    {
        $this->bootIfNotBooted();
    }
}
