<?php
/**
 * Part of the Laradic PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Support\Tests;

use Laradic\Tests\Support\Fixture\ServiceProvider;
use Laradic\Testing\Laravel\AbstractTestCase;
use Laradic\Testing\Laravel\Traits\ServiceProviderTester;

/**
 * This is the SupportServiceProviderTest.
 *
 * @package        Laradic\Tests
 * @author         Laradic Dev Team
 * @copyright      Copyright (c) 2015, Laradic
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
