<?php

namespace Laradic\Support\Helpers;

use Stringy\Stringy;
use Laradic\Support\Wrap;


if ( ! function_exists('Laradic\Support\stringy')) {
    function stringy($value = []): Stringy
    {
        return Wrap::stringy($value);
    }
}

