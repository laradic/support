<?php

namespace Laradic\Support\Commands;

use Closure;
use Stringy\StaticStringy;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Container\Container;

class AddMixins
{
    /** @var array */
    protected $mixins;

    public static $handled = false;

    public function __construct(array $mixins = null)
    {
        $this->mixins = $mixins;
    }

    public function withDefaultMixins()
    {
        $config       = require dirname(dirname(__DIR__)) . '/config/laradic.support.php';
        $this->mixins = $config[ 'mixins' ];
        return $this;
    }

    public function handle()
    {
        if (static::$handled) {
            return;
        }
        static::$handled = true;
        foreach ($this->mixins as $for => $methods) {
            if (method_exists($this, $for)) {
                $this->{$for}($methods);
            }
        }
    }

    protected function addMacros($class, array $names = [], $directory= null)
    {
        $directory = $directory ?? last(explode('\\', $class));
        collect(glob(__DIR__ . '/../Macros/' . $directory . '/*.php', GLOB_NOSORT))
            ->mapWithKeys(function ($path) {
                return [ $path => pathinfo($path, PATHINFO_FILENAME) ];
            })
            ->reject(function ($macro) use ($names, $class) {

                return forward_static_call_array([ $class, 'hasMacro' ], [ Str::camel($macro) ]) || ! in_array(Str::camel($macro), $names);
            })
            ->each(function ($macro, $path) use ($directory, $class) {
                $macroClass = 'Laradic\\Support\\Macros\\' . $directory . '\\' . $macro;
                $app        = Container::getInstance();
                forward_static_call_array([ $class, 'macro' ], [ Str::camel($macro), $app->make($macroClass)() ]);
            });

        Arr::macro('cut', function (array &$array, array $names, $cb = null) {
            $res   = Arr::only($array, $names);
            $array = Arr::except($array, $names);
            if ($cb instanceof Closure) {
                $cb($array);
            }
            return $res;
        });
    }

    public function eloquentCollection(array $names = [])
    {
        $this->addMacros(\Illuminate\Database\Eloquent\Collection::class, $names,'EloquentCollection');
    }

    public function collection(array $names = [])
    {
        $this->addMacros(\Illuminate\Support\Collection::class, $names);
    }


    public function arr(array $names = [])
    {
        $this->addMacros(\Illuminate\Support\Arr::class, $names);
    }

    public function str(array $names = [])
    {
        $this->addMacros(\Illuminate\Support\Str::class, $names);
    }

    public function filesystem(array $names = [])
    {
        $this->addMacros(\Illuminate\Filesystem\Filesystem::class, $names);
    }

    public function stringy(array $names = [])
    {
        collect($names)->each(function ($method) {
            Str::macro($method, function (...$params) use ($method) {
                if ( ! method_exists(Str::class, $method)) {
                    return forward_static_call_array([ StaticStringy::class, $method ], $params);
                }
            });
        });
    }

    public function byte_units(array $names = [])
    {
        $macros = [
            'bytes'            => function ($bytes) {
                return \ByteUnits\bytes($bytes);
            },
            'bytesMetric'      => function ($bytes) {
                return \ByteUnits\Metric::bytes($bytes);
            },
            'bytesBinary'      => function ($bytes) {
                return \ByteUnits\Binary::bytes($bytes);
            },
            'parseBytes'       => function ($bytes) {
                return \ByteUnits\parse($bytes);
            },
            'parseBytesMetric' => function ($bytes) {
                return \ByteUnits\Metric::parse($bytes);
            },
            'parseBytesBinary' => function ($bytes) {
                return \ByteUnits\Binary::parse($bytes);
            },
        ];

        collect($macros)->reject(function ($method, $name) use ($names) {
            return ! in_array($name, $names, true) && ! Str::hasMacro($name);
        })->each(function ($method, $name) {
            Str::macro($name, $method);
        });
    }
}
