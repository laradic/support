<?php
/**
 * Laradic Support helper methods
 *
 * @author    Laradic Dev Team
 * @copyright Copyright (c) 2015, Laradic
 * @license   https://tldrlegal.com/license/mit-license MIT License
 * @package   Laradic\Support
 */

if (!function_exists('stringy')) {
    /**
     * stringy method
     *
     * @param      $str
     * @param null $encoding
     *
     * @return \Stringy\Stringy
     */
    function stringy($str, $encoding = null)
    {

        return \Stringy\Stringy::create($str);
    }
}

if (!function_exists('str_first')) {
    /**
     * str_first
     *
     * @param string $subject
     * @param int    $n
     *
     * @return string
     */
    function str_first($subject, $n)
    {
        return forward_static_call_array([ 'Laradic\Support\Str', 'first' ], func_get_args());
    }
}

if (!function_exists('str_last')) {
    /**
     * str_last
     *
     * @return string
     */
    function str_last($subject, $n)
    {
        return forward_static_call_array([ 'Laradic\Support\Str', 'last' ], func_get_args());
    }
}

if (!function_exists('str_ensure_left')) {
    /**
     * str_ensure_left
     *
     * @return string
     */
    function str_ensure_left($subject, $substring)
    {
        return forward_static_call_array([ 'Laradic\Support\Str', 'ensureLeft' ], func_get_args());
    }
}

if (!function_exists('str_ensure_right')) {
    /**
     * str_ensure_right
     *
     * @return string
     */
    function str_ensure_right($subject, $substring)
    {
        return forward_static_call_array([ 'Laradic\Support\Str', 'ensureRight' ], func_get_args());
    }
}

if (!function_exists('str_remove_left')) {
    /**
     * str_remove_left
     *
     * @return string
     */
    function str_remove_left($subject, $substring)
    {
        return forward_static_call_array([ 'Laradic\Support\Str', 'removeLeft' ], func_get_args());
    }
}

if (!function_exists('str_remove_right')) {
    /**
     * str_remove_right
     *
     * @return string
     */
    function str_remove_right($subject, $substring)
    {
        return forward_static_call_array([ 'Laradic\Support\Str', 'removeRight' ], func_get_args());
    }
}

if (!function_exists('path_join')) {
    /**
     * path_join method
     *
     * @param string|array ...$path
     *
     * @return mixed
     *
     */
    function path_join($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'join' ], func_get_args());
    }
}

if (!function_exists('path_real')) {
    /**
     * path_real method
     * @return mixed
     */
    function path_real()
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'real' ], func_get_args());
    }
}

if (!function_exists('path_njoin')) {
    /**
     * path_njoin method
     * @return mixed
     */
    function path_njoin()
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'njoin' ], func_get_args());
    }
}

if (!function_exists('path_is_absolute')) {
    /**
     * path_is_absolute method
     *
     * @param $path
     *
     * @return mixed
     */
    function path_is_absolute($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'isAbsolute' ], func_get_args());
    }
}

if (!function_exists('path_is_relative')) {
    /**
     * path_is_relative method
     *
     * @param $path
     *
     * @return mixed
     */
    function path_is_relative($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'isRelative' ], func_get_args());
    }
}

if (!function_exists('path_get_directory')) {
    /**
     * path_get_directory method
     *
     * @param $path
     *
     * @return mixed
     */
    function path_get_directory($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'getDirectory' ], func_get_args());
    }
}

if (!function_exists('path_get_extension')) {
    /**
     * path_get_extension method
     *
     * @param $path
     *
     * @return mixed
     */
    function path_get_extension($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'getExtension' ], func_get_args());
    }
}

if (!function_exists('path_get_filename')) {
    /**
     * path_get_filename method
     *
     * @param $path
     *
     * @return mixed
     */
    function path_get_filename($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'getFilename' ], func_get_args());
    }
}

if (!function_exists('path_get_filename_without_extension')) {
    /**
     * path_get_filename method
     *
     * @param $path
     *
     * @return mixed
     */
    function path_get_filename_without_extension($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'getFilenameWithoutExtension' ], func_get_args());
    }
}


if (!function_exists('path_relative')) {
    /**
     * path_relative method
     *
     * @param $from
     * @param $basePath
     *
     * @return mixed
     */
    function path_relative($from, $basePath)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'makeRelative' ], func_get_args());
    }
}

if (!function_exists('path_absolute')) {
    /**
     * path_absolute method
     *
     * @param $path
     *
     * @return mixed
     */
    function path_absolute($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'makeAbsolute' ], func_get_args());
    }
}

if (!function_exists('path_normalize')) {
    /**
     * path_normalize method
     *
     * @param $path
     *
     * @return mixed
     */
    function path_normalize($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'canonicalize' ], func_get_args());
    }
}

if (!function_exists('path_canonicalize')) {
    /**
     * path_canonicalize method
     *
     * @param $path
     *
     * @return mixed
     */
    function path_canonicalize($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'canonicalize' ], func_get_args());
    }
}

if (!function_exists('path_canonicalize')) {
    /**
     * path_get_home method
     * @return mixed
     */
    function path_get_home()
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'getHome' ], func_get_args());
    }
}

if (!function_exists('path_canonicalize')) {
    /**
     * path_canonicalize method
     *
     * @param $path
     *
     * @return mixed
     */
    function path_canonicalize($path)
    {
        return forward_static_call_array([ 'Laradic\Support\Path', 'canonicalize' ], func_get_args());
    }
}
