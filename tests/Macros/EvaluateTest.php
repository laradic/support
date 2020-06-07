<?php

namespace Laradic\Tests\Support\Macros;

use Laradic\Tests\Support\TestCase;
use Illuminate\Support\Collection;

class EvaluateTest extends TestCase
{
    protected $data = [];

    public function setUp():void
    {
        parent::setUp();
        $this->data = $this->getFixtureDataArray();
    }

    protected function createCollection(array $data = null)
    {
        return new Collection($data === null ? $this->data : $data);
    }

    public function testEvaluateArray()
    {
        $col = $this->createCollection();

        $this->assertTrue(true);
    }


    public function testEvaluateInstanceArray()
    {
        $col = $this->createCollection($this->getFixtureUserArray());

        $this->assertTrue(true);
    }

}
