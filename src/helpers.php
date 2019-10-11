<?php


if(!function_exists('rglob')){
    function rglob($pattern, $flag = 0){
        return \Laradic\Support\FS::rglob($pattern, $flag);
    }
}



if(!function_exists('array_differences')) {
    function array_differences($before, $after, &$added, &$removed)
    {
        $added   = array_diff($after, $before);
        $removed = array_diff($before, $after);
    }
}