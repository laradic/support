<?php

namespace Laradic\Support;

class MultiBench extends Bench
{

    /** @var Bench[] */
    protected static $instances = [];

    protected static $enabled = false;

    /** @var Bench */
    protected static $default;

    public static function keys()
    {
        return array_keys(static::$instances);
    }

    public static function on($key)
    {
        if ( ! array_key_exists($key, static::$instances)) {
            static::$instances[ $key ] = new static();
            if ( ! static::default()) {
                static::setDefault(static::$instances[ $key ]);
            }
        }
        return static::$instances[ $key ];
    }

    public static function all()
    {
        return static::$instances;
    }

    public static function isEnabled()
    {
        return self::$enabled;
    }

    public static function setEnabled($enabled)
    {
        self::$enabled = $enabled;
        return static::class;
    }

    public static function enable()
    {
        static::setEnabled(true);
        return static::class;
    }

    public static function disable()
    {
        static::setEnabled(true);
        return static::class;
    }

    public static function setDefault($default)
    {
        static::$default = $default;
        return static::class;
    }

    public static function default()
    {
        if (static::$default === null) {
            static::$default = static::$instances[ static::keys()[ 0 ] ];
        }
        return static::$default;
    }

    public function start($mark = false)
    {
        return static::$enabled ? parent::start($mark) : $this;
    }

    public function stop($mark = false)
    {
        return static::$enabled ? parent::stop($mark) : $this;
    }

    public function reset()
    {
        return static::$enabled ? parent::reset() : $this;
    }

    public function mark($id)
    {
        return static::$enabled ? parent::mark($id) : $this;
    }

    public function dump($die = true)
    {
        return static::$enabled ? parent::dump($die) : $this;
    }


    public static function dmark($id)
    {
        return static::default()->mark($id);
    }

}