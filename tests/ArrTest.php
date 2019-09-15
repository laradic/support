<?php
/**
 * Part of the Laradic PHP Packages.
 * Copyright (c) 2017. Robin Radic.
 * The license can be found in the package and online at https://laradic.mit-license.org.
 *
 * @copyright Copyright 2017 (c) Robin Radic
 * @license   https://laradic.mit-license.org The MIT License
 */

namespace Laradic\Tests\Support;


use Illuminate\Support\Arr;

class ArrTest extends TestCase
{

    public $array = [ 'foo' => 'bar', 'bis' => 'ter' ];
    public $arrayNumbers = [ 1, 2, 3 ];
    public $arrayMulti = [
        [ 'foo' => 'bar', 'bis' => 'ter' ],
        [ 'foo' => 'bar', 'bis' => 'ter' ],
        [ 'bar' => 'foo', 'bis' => 'ter' ],
    ];
    public $object;

    /**
     * Restore data just in case.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->object      = (object)$this->array;
        $this->objectMulti = (object)[
            (object)$this->arrayMulti[ 0 ],
            (object)$this->arrayMulti[ 1 ],
            (object)$this->arrayMulti[ 2 ],
        ];
    }

    public function testIsAssoc()
    {
        $this->assertTrue(Arr::isAssoc([ 'a' => 'a', 0 => 'b' ]));
        $this->assertTrue(Arr::isAssoc([ 1 => 'a', 0 => 'b' ]));
        $this->assertTrue(Arr::isAssoc([ 1 => 'a', 2 => 'b' ]));
        $this->assertFalse(Arr::isAssoc([ 0 => 'a', 1 => 'b' ]));
        $this->assertFalse(Arr::isAssoc([ 'a', 'b' ]));
    }

    public function testSortRecursive()
    {
        $array  = [
            'users'        => [
                [
                    // should sort associative arrays by keys
                    'name'    => 'joe',
                    'mail'    => 'joe@example.com',
                    // should sort deeply nested arrays
                    'numbers' => [ 2, 1, 0 ],
                ],
                [
                    'name' => 'jane',
                    'age'  => 25,
                ],
            ],
            'repositories' => [
                // should use weird `sort()` behavior on arrays of arrays
                [ 'id' => 1 ],
                [ 'id' => 0 ],
            ],
            // should sort non-associative arrays by value
            20             => [ 2, 1, 0 ],
            30             => [
                // should sort non-incrementing numerical keys by keys
                2 => 'a',
                1 => 'b',
                0 => 'c',
            ],
        ];
        $expect = [
            20             => [ 0, 1, 2 ],
            30             => [
                0 => 'c',
                1 => 'b',
                2 => 'a',
            ],
            'repositories' => [
                [ 'id' => 0 ],
                [ 'id' => 1 ],
            ],
            'users'        => [
                [
                    'age'  => 25,
                    'name' => 'jane',
                ],
                [
                    'mail'    => 'joe@example.com',
                    'name'    => 'joe',
                    'numbers' => [ 0, 1, 2 ],
                ],
            ],
        ];
        $this->assertEquals($expect, Arr::sortRecursive($array));
    }


    // Tests --------------------------------------------------------- /

    public function testCanUseClassDirectly()
    {
        $under = Arr::get($this->array, 'foo');

        $this->assertEquals('bar', $under);
    }

    public function testCanCheckIfHasValue()
    {
        $under = Arr::has($this->array, 'foo');

        $this->assertTrue($under);
    }

    public function testCanGetValueFromArray()
    {
        $array = [ 'foo' => [ 'bar' => 'bis' ] ];
        $under = Arr::get($array, 'foo.bar');

        $this->assertEquals('bis', $under);
    }

    public function testCantConflictWithNativeFunctions()
    {
        $array = [ 'foo' => [ 'bar' => 'bis' ] ];
        $under = Arr::get($array, 'ter', 'str_replace');

        $this->assertEquals('str_replace', $under);
    }

    public function testCanFallbackClosure()
    {
        $array = [ 'foo' => [ 'bar' => 'bis' ] ];
        $under = Arr::get($array, 'ter', function () {
            return 'closure';
        });

        $this->assertEquals('closure', $under);
    }

    public function testCanPluckColumns()
    {
        $under   = Arr::pluck($this->arrayMulti, 'foo');
        $matcher = [ 'bar', 'bar', null ];

        $this->assertEquals($matcher, $under);
    }

    public function testCanGetLastValue()
    {
        $under = Arr::last($this->array);

        $this->assertEquals('ter', $under);
    }


    public function testCanGetRandomValue()
    {
        $array = Arr::random($this->array);

        $this->assertContains($array, $this->array);
    }

    public function testCanGetSeveralRandomValue()
    {
        $array = Arr::random($this->arrayNumbers, 2);
        foreach ($array as $a) {
            $this->assertContains($a, $this->arrayNumbers);
        }
    }

    public function testCanPrependValuesToArrays()
    {
        $array   = Arr::prepend($this->array, 'foo');
        $matcher = [ 0 => 'foo', 'foo' => 'bar', 'bis' => 'ter' ];

        $this->assertEquals($matcher, $array);
    }


}
