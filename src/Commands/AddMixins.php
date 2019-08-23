<?php

namespace Laradic\Support\Commands;

use Stringy\StaticStringy;
use Illuminate\Support\Str;
use Illuminate\Container\Container;

class AddMixins
{
    /** @var array */
    protected $mixins;

    public function __construct(array $mixins = null)
    {
        $this->mixins = $mixins;
    }

    public function handle()
    {
        foreach ($this->mixins as $for => $methods) {
            if (method_exists($this, $for)) {
                $this->{$for}($methods);
            }
        }
    }

    protected function addMacros($for, array $names = [])
    {
        $className = ucfirst($for);
        $class     = 'Illuminate\\Support\\' . $className;
        collect(glob(__DIR__ . '/../Macros/' . $className . '/*.php', GLOB_NOSORT))
            ->mapWithKeys(function ($path) {
                return [ $path => pathinfo($path, PATHINFO_FILENAME) ];
            })
            ->reject(function ($macro) use ($names, $class) {

                return forward_static_call([ $class, 'hasMacro' ], Str::camel($macro)) || ! in_array(Str::camel($macro), $names);
            })
            ->each(function ($macro, $path) use ($className, $class) {
                $macroClass = 'Laradic\\Support\\Macros\\' . $className . '\\' . $macro;
                $app        = Container::getInstance();
                forward_static_call([ $class, 'macro' ], Str::camel($macro), $app->make($macroClass)());
            });
    }

    public function collection(array $names = [])
    {
        $this->addMacros('collection', $names);
    }


    public function arr(array $names = [])
    {
        $this->addMacros('arr', $names);
    }

    public function str(array $names = [])
    {
        $this->addMacros('str', $names);
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
