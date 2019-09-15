<?php


if(!function_exists('rglob')){
    function rglob($pattern, $flag = 0){
        $pattern = preg_replace('/\*\*/','{,*/,*/*/,*/*/*/}{,*/,*/*/,*/*/*/}',$pattern);
        return glob($pattern, GLOB_BRACE|$flag);
    }
}