<?php

namespace Crvs\Tests\Support;

use Crvs\Tests\Support\Fixtures\FixtureUser;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function getFixtureDataArray()
    {
        return require __DIR__ . '/Fixtures/data_array.php';
    }

    /**
     * @return FixtureUser[]
     */
    protected function getFixtureUserArray()
    {
        return array_map([FixtureUser::class, 'make'], $this->getFixtureDataArray());
    }
}
