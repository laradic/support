<?php


namespace Laradic\Support\Macros\Filesystem;


class Rglob
{
    public function __invoke()
    {
        return function ($pattern, $flag = 0) {
            $pattern = preg_replace('/\*\*\//', '{,*/,*/*/,*/*/*/}{,*/,*/*/,*/*/*/}', $pattern);
            return glob($pattern, GLOB_BRACE | $flag);
        };
    }

}