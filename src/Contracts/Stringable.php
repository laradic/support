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

namespace Laradic\Support\Contracts;


/**
 * Interface Stringable
 *
 * @package Laradic\Support\Contracts
 * @author  Robin Radic
 */
interface Stringable
{
    /**
     * __toString method
     *
     * @return mixed
     */
    public function __toString();
}