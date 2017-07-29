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
namespace Laradic\Tests\Support;


/**
 * This is the TestCase.
 *
 * @package        Laradic\Tests
 * @author         Laradic Dev Team
 * @copyright      Copyright (c) 2015, Laradic
 * @license        https://tldrlegal.com/license/mit-license MIT License
 */
abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use CreatesApplication;

    protected function getPackageRootPath()
    {
        return __DIR__ . '/..';
    }
}
