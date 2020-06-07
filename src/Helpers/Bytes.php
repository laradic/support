<?php

namespace Laradic\Support\Helpers;

use Stringy\Stringy;
use ByteUnits\Metric;
use Laradic\Support\Dot;
use Laradic\Support\Wrap;


if ( ! function_exists('Laradic\Support\bytes')) {
    function bytes($value): Metric
    {
        return Wrap::bytes($value);
    }
}