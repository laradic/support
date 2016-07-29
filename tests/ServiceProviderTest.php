<?php
/**
 * Part of the Sebwite PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Support\Tests;

use Laradic\Tests\Support\Fixture\ServiceProvider;
use Sebwite\Testing\Laravel\AbstractTestCase;
use Sebwite\Testing\Laravel\Traits\ServiceProviderTester;

/**
 * This is the SupportServiceProviderTest.
 *
 * @package        Sebwite\Tests
 * @author         Sebwite Dev Team
 * @copyright      Copyright (c) 2015, Sebwite
 * @license        https://tldrlegal.com/license/mit-license MIT License
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTester;

    protected function getServiceProviderClass()
    {
        return ServiceProvider::class;
    }

    protected function getPackageRootPath()
    {
        return __DIR__ . '/..';
    }
}
