<?php

namespace Laradic\Support\Helpers;

use Stringy\Stringy;
use ByteUnits\Metric;
use Laradic\Support\Dot;
use Laradic\Support\Wrap;

if ( ! function_exists('Laradic\Support\dot')) {
    function dot($value = []): Dot
    {
        return Wrap::dot($value);
    }
}

