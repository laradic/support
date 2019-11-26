<?php


if(!function_exists('app_caller')){
    /**
     * @param       $class
     * @param array $parameters
     * @return \Laradic\Support\AppCaller|mixed
     */
    function app_caller($class, $parameters=[]){
        return \Laradic\Support\AppCaller::make($class, $parameters);
    }
}


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


if(!function_exists('class_uses_deep')) {
    function class_uses_deep($class, $autoload = true)
    {
        $traits = [];

        // Get traits of all parent classes
        do {
            $traits = array_merge(class_uses($class, $autoload), $traits);
        }
        while ($class = get_parent_class($class));

        // Get traits of all parent traits
        $traitsToSearch = $traits;
        while ( ! empty($traitsToSearch)) {
            $newTraits      = class_uses(array_pop($traitsToSearch), $autoload);
            $traits         = array_merge($newTraits, $traits);
            $traitsToSearch = array_merge($newTraits, $traitsToSearch);
        };

        foreach ($traits as $trait => $same) {
            $traits = array_merge(class_uses($trait, $autoload), $traits);
        }

        return array_unique($traits);
    }
}