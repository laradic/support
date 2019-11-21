<?php

namespace Laradic\Support;

class MultiBench extends Bench
{

    /** @var Bench[] */
    protected static $instances = [];

    protected static $enabled = false;

    public static function keys()
    {
        return array_keys(static::$instances);
    }

    public static function on($key)
    {
        if ( ! array_key_exists($key, static::$instances)) {
            static::$instances[ $key ] = new static();
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


}