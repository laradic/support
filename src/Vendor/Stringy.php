<?php

namespace Laradic\Support\Vendor;

use Stringy\Stringy as BaseStringy;

/**
 * Stringy.
 *
 * @author    Laradic Dev Team
 * @copyright Copyright (c) 2015, Laradic
 * @license   https://tldrlegal.com/license/mit-license MIT License
 */
class Stringy extends BaseStringy
{
    /**
     * Magic call static method.
     *
     * @param string $name
     * @param mixed  $parameters
     *
     * @return mixed
     */
    public static function __callStatic($name, $parameters)
    {
        return call_user_func_array([static::create(head($parameters)), $name], array_slice($parameters, 1));
    }

    /**
     * Studly Namespace.
     *
     * Transforms "vendor-name/package-name" into "VendorName/PackageName".
     *
     * @return Stringy
     */
    public function namespacedStudly()
    {
        $str = implode('\\', array_map('studly_case', explode('/', $this->str)));

        return static::create($str, $this->encoding);
    }

    /**
     * Explode a string into an array.
     *
     * @param string   $delimiter
     * @param int|null $limit
     *
     * @return array
     */
    public function split($delimiter, $limit = null)
    {
        return explode($delimiter, $this->str, $limit);
    }

    /**
     * {@inheritdoc}
     */
    public function startsWith($substring, $caseSensitive = true)
    {
        return (bool) parent::startsWith($substring, $caseSensitive);
    }
}
