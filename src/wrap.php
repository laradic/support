<?php

namespace Laradic\Support;

use Stringy\Stringy;
use ByteUnits\Metric;

if ( ! function_exists('Laradic\Support\dot')) {
    function dot($value = []): Dot
    {
        return Wrap::dot($value);
    }
}


if ( ! function_exists('Laradic\Support\stringy')) {
    function stringy($value = []): Stringy
    {
        return Wrap::stringy($value);
    }
}


if ( ! function_exists('Laradic\Support\bytes')) {
    function bytes($value): Metric
    {
        return Wrap::bytes($value);
    }
}