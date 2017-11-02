<?php
/**
 * Part of the Laradic PHP Packages.
 *
 * Copyright (c) 2017. Robin Radic.
 *
 * The license can be found in the package and online at https://laradic.mit-license.org.
 *
 * @copyright Copyright 2017 (c) Robin Radic
 * @license https://laradic.mit-license.org The MIT License
 */
namespace Laradic\Support;

/**
 * This is the class Path.
 *
 * @package        Laradic\Support
 * @author         Laradic
 * @copyright      Copyright (c) 2015, Laradic. All rights reserved
 */
class Path extends Vendor\Path
{

    public static function isPhar($path = null)
    {
        $path = $path === null ? __FILE__ : $path;

        return Str::startsWith($path, 'phar://');
    }

    /**
     * Equivalent of realpath() accept for Phar paths
     *
     * @param $path
     *
     * @return string
     */
    public static function real($path)
    {
        return static::isPhar($path) ? $path : realpath($path);
    }

    /**
     * Joins a split file system path.
     *
     * @param  array|string $path
     *
     * @return string
     */
    public static function joinPaths($paths)
    {
        $arguments = func_get_args();

        if (func_num_args() === 1 and is_array($arguments[ 0 ])) {
            $arguments = $arguments[ 0 ];
        }

        foreach ($arguments as $key => &$argument) {
            if (is_array($argument)) {
                $argument = static::join($argument);
            }
            $argument = Str::removeRight($argument, '/');

            if ($key > 0) {
                $argument = Str::removeLeft($argument, '/');
            }
            #$arguments[ $key ] = $argument;
        }

        return implode(DIRECTORY_SEPARATOR, $arguments);
    }

    /**
     * Similar to the join() method, but also normalize()'s the result
     *
     * @return string
     */
    public static function njoin()
    {
        return static::canonicalize(static::join(func_get_args()));
    }

    /**
     * Get the directory path
     *
     * @param $path
     *
     * @return mixed|string
     */
    public static function getDirectoryName($path)
    {
        $path = static::real($path);
        if (is_dir($path)) {
            return last(explode(DIRECTORY_SEPARATOR, $path));
        } else {
            return static::getDirectory($path);
        }
    }

    /**
     * Return the user's home directory.
     */
    public static function getHome()
    {
        // Cannot use $_SERVER superglobal since that's empty during UnitUnishTestCase
        // getenv('HOME') isn't set on Windows and generates a Notice.
        $home = getenv('HOME');
        if ( ! empty($home)) {
            // home should never end with a trailing slash.
            $home = rtrim($home, '/');
        } elseif ( ! empty($_SERVER[ 'HOMEDRIVE' ]) && ! empty($_SERVER[ 'HOMEPATH' ])) {
            // home on windows
            $home = $_SERVER[ 'HOMEDRIVE' ] . $_SERVER[ 'HOMEPATH' ];
            // If HOMEPATH is a root directory the path can end with a slash. Make sure
            // that doesn't happen.
            $home = rtrim($home, '\\/');
        }

        return empty($home) ? null : $home;
    }

    /**
     * Removes the extension of a path string.
     *
     * @param string $path The path string with filename.ext to change
     *
     * @return string The path string without any extension
     */
    public static function withoutExtension($path)
    {
        $extension = self::getExtension($path);
        if (empty($extension)) {
            return $path;
        }
        return substr($path, 0, -(strlen($extension) + 1));
    }

    /**
     * Splits a part into its root directory and the remainder.
     *
     * If the path has no root directory, an empty root directory will be
     * returned.
     *
     * If the root directory is a Windows style partition, the resulting root
     * will always contain a trailing slash.
     *
     * list ($root, $path) = Path::split("C:/webmozart")
     * // => array("C:/", "webmozart")
     *
     * list ($root, $path) = Path::split("C:")
     * // => array("C:/", "")
     *
     * @param string $path The canonical path to split
     *
     * @return array An array with the root directory and the remaining relative
     *               path
     */
    private static function split($path)
    {
        if ('' === $path) {
            return [ '', '' ];
        }

        $root   = '';
        $length = strlen($path);

        // Remove and remember root directory
        if ('/' === $path[ 0 ]) {
            $root = '/';
            $path = $length > 1 ? substr($path, 1) : '';
        } elseif ($length > 1 && ctype_alpha($path[ 0 ]) && ':' === $path[ 1 ]) {
            if (2 === $length) {
                // Windows special case: "C:"
                $root = $path . '/';
                $path = '';
            } elseif ('/' === $path[ 2 ]) {
                // Windows normal case: "C:/"..
                $root = substr($path, 0, 3);
                $path = $length > 3 ? substr($path, 3) : '';
            }
        }

        return [ $root, $path ];
    }

    /**
     * Converts string to lower-case (multi-byte safe if mbstring is installed).
     *
     * @param string $str The string
     *
     * @return string Lower case string
     */
    private static function toLower($str)
    {
        if (function_exists('mb_strtolower')) {
            return mb_strtolower($str, mb_detect_encoding($str));
        }

        return strtolower($str);
    }

    private function __construct()
    {
        throw new \BadMethodCallException('Path should not be instanciated');
    }
}
