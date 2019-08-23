<?php

namespace Laradic\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;

class Wrap
{
    use Macroable;

    public static function dot($value = [])
    {
        return new Dot($value);
    }

    public static function collect($value = [])
    {
        return new Collection($value);
    }

    public static function stringy($string = '', $encoding = null)
    {
        return \Stringy\Stringy::create($string, $encoding);
    }

    public static function bytes($bytes)
    {
        return \ByteUnits\bytes($bytes);
    }

    public static function bytesMetric($bytes)
    {
        return \ByteUnits\Metric::bytes($bytes);
    }

    public static function bytesBinary($bytes)
    {
        return \ByteUnits\Binary::bytes($bytes);
    }

    public static function parseBytes($bytes)
    {
        return \ByteUnits\parse($bytes);
    }

    public static function parseBytesMetric($bytes)
    {
        return \ByteUnits\Metric::parse($bytes);
    }

    public static function parseBytesBinary($bytes)
    {
        return \ByteUnits\Binary::parse($bytes);
    }
}
