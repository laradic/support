<?php
/**
 * Part of the Laradic PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
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
abstract class TestCase extends \Laradic\Testing\Native\AbstractTestCase
{

    protected function getPackageRootPath()
    {
        return __DIR__ . '/..';
    }
}
