<?php

namespace Laradic\Support\Macros\Str;

class Ancronym
{

    public function __invoke()
    {
        return function($string){
            return preg_replace('/\b(\w)\w*\W*/', '\1', $string);
        };
    }
}