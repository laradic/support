<?php

namespace Laradic\Tests\Support;

use Laradic\Support\Commands\AddMixins;
use Laradic\Tests\Support\Fixtures\FixtureUser;

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

    public function setUp():void
    {
        $config=require __DIR__.'/../config/laradic.support.php';
        $command = new AddMixins($config['mixins']);
        $command->handle();
    }
}
