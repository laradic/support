<?php
/**
 * Part of the Sebwite PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Tests\Support;


/**
 * This is the TestCase.
 *
 * @package        Sebwite\Tests
 * @author         Sebwite Dev Team
 * @copyright      Copyright (c) 2015, Sebwite
 * @license        https://tldrlegal.com/license/mit-license MIT License
 */
abstract class TestCase extends \Sebwite\Testing\Native\AbstractTestCase
{

    protected function getPackageRootPath()
    {
        return __DIR__ . '/..';
    }
}
