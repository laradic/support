<?php


if(!function_exists('rglob')){
    function rglob($pattern, $flag = 0){
        return \Laradic\Support\FS::rglob($pattern, $flag);
    }
}