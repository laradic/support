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
 * Array helper methods.
 *
 * @author    Laradic Dev Team
 * @copyright Copyright (c) 2015, Laradic
 * @license   https://tldrlegal.com/license/mit-license MIT License
 * @codeCoverageIgnore
 * @mixin \Underscore\Methods\ArraysMethods
 * @mixin \Illuminate\Support\Arr
 */
class Arr
{
    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([new static(), $name], $arguments);
    }

    public function __call($name, $arguments)
    {
        if (method_exists('Underscore\Methods\ArraysMethods', $name)) {
            return forward_static_call_array(['Underscore\Types\Arrays', $name], $arguments);
        } elseif (method_exists('Illuminate\Support\Arr', $name)) {
            return forward_static_call_array(['Illuminate\Support\Arr', $name], $arguments);
        }
    }

    /**
     * checks if each key is an integer value.
     *
     * @see      \Laradic\Support\Arr::isAssoc()
     * @see      \Laradic\Support\Arr::isSequential()
     * @see     https://stackoverflow.com/a/11495941/2643122 Is associative? how-to-check-if-php-array-is-associative-or-sequential
     *
     * @param array $arr
     *
     * @return bool
     */
    public static function isIndexed(array &$arr)
    {
        for (reset($arr); is_int(key($arr)); next($arr));

        return null === key($arr);
    }

    /**
     * checks if each key is an integer value and if all keys are sequential starting at $base.
     *
     * @see      \Laradic\Support\Arr::isAssoc()
     * @see      \Laradic\Support\Arr::isIndexed()
     * @see     https://stackoverflow.com/a/11495941/2643122 Is associative? how-to-check-if-php-array-is-associative-or-sequential
     *
     * @param array $arr
     * @param int   $base defaults to 0 and thus can be omitted if you do not need to specify another base value
     *
     * @return bool
     */
    public static function isSequential(array &$arr, $base = 0)
    {
        for (reset($arr), $base = (int) $base; key($arr) === $base++; next($arr));

        return null === key($arr);
    }

    /**
     * Unflattens a single stacked array back into a multidimensional array.
     *
     * @param array  $array
     * @param string $delimiter
     *
     * @return array
     */
    public static function unflatten(array $array, $delimiter = '.')
    {
        $unflattenedArray = [];

        foreach ($array as $key => $value) {
            $keyList = explode($delimiter, $key);
            $firstKey = array_shift($keyList);

            if (count($keyList) > 0) {
                $subArray = static::unflatten([implode($delimiter, $keyList) => $value], $delimiter);

                foreach ($subArray as $subArrayKey => $subArrayValue) {
                    $unflattenedArray[$firstKey][$subArrayKey] = $subArrayValue;
                }
            } else {
                $unflattenedArray[$firstKey] = $value;
            }
        }

        return $unflattenedArray;
    }

    /**
     * Get a value from the passed array, and remove it.
     *
     * @param array  $array
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public static function pull(&$array, $key, $default = null)
    {
        $value = static::get($array, $key, $default);

        static::forget($array, $key);

        return $value;
    }

    /**
     * Set an array item to a given value using "dot" notation.
     *
     * If no key is provided, the entire array will be replaced.
     *
     * @param array  $array
     * @param string $key
     * @param mixed  $value
     *
     * @return array
     */
    public static function set(&$array, $key, $value)
    {
        if (null === $key) {
            return $array = $value;
        }

        $keys = explode('.', $key);

        while (count($keys) > 1) {
            $key = array_shift($keys);

            // If the key doesn't exist at this depth, we will just create an empty array
            // to hold the next value, allowing us to create the arrays to hold final
            // values at the correct depth. Then we'll keep digging into the array.
            if (!isset($array[$key]) or !is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }

    /**
     * Remove one or more array key items from the given array using "dot" notation.
     *
     * @param array  $array
     * @param string $keys
     */
    public static function forget(&$array, $keys)
    {
        $original = &$array;

        foreach ((array) $keys as $key) {
            $parts = explode('.', $key);

            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (isset($array[$part]) and is_array($array[$part])) {
                    $array = &$array[$part];
                }

                unset($array[array_shift($parts)]);

                $array = &$original;
            }
        }
    }

    /**
     * from method.
     *
     * @param array $arr
     *
     * @return \Underscore\Types\Arrays
     */
    public static function from($arr = [])
    {
        return \Underscore\Types\Arrays::from($arr);
    }

    public static function sortPaths(array $paths, $rootFirst = false, $separator = DIRECTORY_SEPARATOR)
    {
        usort($paths, function ($a, $b) use ($rootFirst, $separator) {
            $a = trim(trim($a, $separator));
            $b = trim(trim($b, $separator));
            if ($a === $b) {
                return 0;
            }
            $aPath = explode($separator, $a);
            $bPath = explode($separator, $b);
            // find first distinct path element
            $aNode = array_shift($aPath);
            $bNode = array_shift($bPath);
            while ($aNode === $bNode) {
                $aNode = array_shift($aPath);
                $bNode = array_shift($bPath);
            }
            // if one of the paths has finished then it means they're in root
            if (empty($aPath) && !empty($bPath)) {
                return $rootFirst ? -1 : 1;
            } else {
                if (empty($bPath) && !empty($aPath)) {
                    return $rootFirst ? 1 : -1;
                }
            }
            // normal sort comparison based on first distinct element
            $order = [$aNode, $bNode];
            sort($order);

            return $order[0] === $aNode ? -1 : 1;
        });

        return $paths;
    }

    /**
     * Sort an array of objects you would do something like:
     * Arr::orderBy($objectAry, 'getCreationDate() DESC, getSubOrder() ASC');.
     *
     * This would sort an array of objects that have methods getCreationDate() and getSubOrder().
     *
     * @param array  $ary       the array we want to sort
     * @param string $clause    a string specifying how to sort the array similar to SQL ORDER BY clause
     * @param bool   $ascending that default sorts fall back to when no direction is specified
     *
     * @example
     * $testAry = array(
     * array('a' => 1, 'b' => 2, 'c' => 3),
     * array('a' => 2, 'b' => 1, 'c' => 3),
     * array('a' => 3, 'b' => 2, 'c' => 1),
     * array('a' => 1, 'b' => 3, 'c' => 2),
     * array('a' => 2, 'b' => 3, 'c' => 1),
     * array('a' => 3, 'b' => 1, 'c' => 2)
     * );
     *
     * Arr::orderBy($testAry, 'a ASC, b DESC');
     *
     * //Result:
     * $testAry = array(
     * array('a' => 1, 'b' => 3, 'c' => 2),
     * array('a' => 1, 'b' => 2, 'c' => 3),
     * array('a' => 2, 'b' => 3, 'c' => 1),
     * array('a' => 2, 'b' => 1, 'c' => 3),
     * array('a' => 3, 'b' => 2, 'c' => 1),
     * array('a' => 3, 'b' => 1, 'c' => 2)
     * );
     * ?>
     */
    public static function orderBy(&$ary, $clause, $ascending = true)
    {
        $clause = str_ireplace('order by', '', $clause);
        $clause = preg_replace('/\s+/', ' ', $clause);
        $keys = explode(',', $clause);
        $dirMap = ['desc' => 1, 'asc' => -1];
        $def = $ascending ? -1 : 1;

        $keyAry = [];
        $dirAry = [];
        foreach ($keys as $key) {
            $key = explode(' ', trim($key));
            $keyAry[] = trim($key[0]);
            if (isset($key[1])) {
                $dir = strtolower(trim($key[1]));
                $dirAry[] = $dirMap[$dir] ? $dirMap[$dir] : $def;
            } else {
                $dirAry[] = $def;
            }
        }

        $fnBody = '';
        for ($i = count($keyAry) - 1; $i >= 0; --$i) {
            $k = $keyAry[$i];
            $t = $dirAry[$i];
            $f = -1 * $t;
            $aStr = '$a[\''.$k.'\']';
            $bStr = '$b[\''.$k.'\']';
            if (false !== strpos($k, '(')) {
                $aStr = '$a->'.$k;
                $bStr = '$b->'.$k;
            }

            if ('' == $fnBody) {
                $fnBody .= "if({$aStr} == {$bStr}) { return 0; }\n";
                $fnBody .= "return ({$aStr} < {$bStr}) ? {$t} : {$f};\n";
            } else {
                $fnBody = "if({$aStr} == {$bStr}) {\n".$fnBody;
                $fnBody .= "}\n";
                $fnBody .= "return ({$aStr} < {$bStr}) ? {$t} : {$f};\n";
            }
        }

        if ($fnBody) {
            $sortFn = create_function('$a,$b', $fnBody);
            usort($ary, $sortFn);
        }
    }

    public static function onlyDot(array $array, $keys)
    {
        $result = [];
        foreach ($keys as $i => $key) {
            data_set($result, $key, data_get($array, $key));
        }

        return $result;
    }

    public static function inheritedMerge(array $parent, array $inheritKeys, array $target, array ...$sources)
    {
        $inherited = static::onlyDot($parent, $inheritKeys);

        return forward_static_call_array(['Codex\Support\Arr', 'mergeUnique'], array_merge([$target, $inherited], $sources));
    }

    public static function mergeUnique(array $target, array ...$sources)
    {
        foreach ($sources as $source) {
            $target = static::merge($target, $source, true);
        }

        return $target;
    }

    /**
     * Merge two arrays recursive.
     *
     * Overwrite values with associative keys
     * Append values with integer keys with the option to only allow unique values
     *
     * @param array $arr1   First array
     * @param array $arr2   Second array
     * @param bool  $unique Set true to not append values that already exists and prevent duplicates when merging integer keyed arrays
     *
     * @return array
     */
    public static function merge(array $arr1, array $arr2, $unique = false)
    {
        if (empty($arr1)) {
            return $arr2;
        } else {
            if (empty($arr2)) {
                return $arr1;
            }
        }
        foreach ($arr2 as $key => $value) {
            if (is_int($key)) {
                if (!$unique || !in_array($value, $arr1, true)) {
                    $arr1[] = $value;
                }
            } elseif (is_array($arr2[$key])) {
                if (!isset($arr1[$key])) {
                    $arr1[$key] = [];
                }

                $value = static::merge($arr1[$key], $value, $unique);
                if (is_int($key)) {
                    $arr1[] = $unique ? array_unique($value) : $value;
                } else {
                    $arr1[$key] = $value;
                }
            } else {
                $arr1[$key] = $value;
            }
        }

        return $arr1;
    }
}
