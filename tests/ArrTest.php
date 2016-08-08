<?php
/**
 * Part of the Laradic PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Tests\Support;

use Laradic\Support\Arr;

/**
 * This is the ArrTest.
 *
 * @package        Laradic\Tests
 * @author         Laradic Dev Team
 * @copyright      Copyright (c) 2015, Laradic
 * @license        https://tldrlegal.com/license/mit-license MIT License
 */
class ArrTest extends TestCase
{
    public $array = ['foo' => 'bar', 'bis' => 'ter'];
    public $arrayNumbers = [1, 2, 3];
    public $arrayMulti = [
        ['foo' => 'bar', 'bis' => 'ter'],
        ['foo' => 'bar', 'bis' => 'ter'],
        ['bar' => 'foo', 'bis' => 'ter'],
    ];
    public $object;

    /**
     * Restore data just in case.
     */
    public function setUp()
    {
        $this->object = (object) $this->array;
        $this->objectMulti = (object) [
            (object) $this->arrayMulti[0],
            (object) $this->arrayMulti[1],
            (object) $this->arrayMulti[2],
        ];
    }
    public function testIsAssoc()
    {
        $this->assertTrue(Arr::isAssoc(['a' => 'a', 0 => 'b']));
        $this->assertTrue(Arr::isAssoc([1 => 'a', 0 => 'b']));
        $this->assertTrue(Arr::isAssoc([1 => 'a', 2 => 'b']));
        $this->assertFalse(Arr::isAssoc([0 => 'a', 1 => 'b']));
        $this->assertFalse(Arr::isAssoc(['a', 'b']));
    }
    public function testSortRecursive()
    {
        $array = [
            'users' => [
                [
                    // should sort associative arrays by keys
                    'name' => 'joe',
                    'mail' => 'joe@example.com',
                    // should sort deeply nested arrays
                    'numbers' => [2, 1, 0],
                ],
                [
                    'name' => 'jane',
                    'age' => 25,
                ],
            ],
            'repositories' => [
                // should use weird `sort()` behavior on arrays of arrays
                ['id' => 1],
                ['id' => 0],
            ],
            // should sort non-associative arrays by value
            20 => [2, 1, 0],
            30 => [
                // should sort non-incrementing numerical keys by keys
                2 => 'a',
                1 => 'b',
                0 => 'c',
            ],
        ];
        $expect = [
            20 => [0, 1, 2],
            30 => [
                0 => 'c',
                1 => 'b',
                2 => 'a',
            ],
            'repositories' => [
                ['id' => 0],
                ['id' => 1],
            ],
            'users' => [
                [
                    'age' => 25,
                    'name' => 'jane',
                ],
                [
                    'mail' => 'joe@example.com',
                    'name' => 'joe',
                    'numbers' => [0, 1, 2],
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
    public function testCanGetKeys()
    {
        $array = Arr::keys($this->array);

        $this->assertEquals(['foo', 'bis'], $array);
    }

    public function testCanGetValues()
    {
        $array = Arr::values($this->array);

        $this->assertEquals(['bar', 'ter'], $array);
    }


    public function testCanRemoveValues()
    {
        $array = Arr::remove($this->arrayMulti, '0.foo');
        $matcher = $this->arrayMulti;
        unset($matcher[0]['foo']);

        $this->assertEquals($matcher, $array);
    }

    public function testCanRemoveMultipleValues()
    {
        $array = Arr::remove($this->arrayMulti, ['0.foo', '1.foo']);
        $matcher = $this->arrayMulti;
        unset($matcher[0]['foo']);
        unset($matcher[1]['foo']);

        $this->assertEquals($matcher, $array);
    }

    public function testCanReturnAnArrayWithoutSomeValues()
    {
        $array = ['foo', 'foo', 'bar', 'bis', 'bar', 'bis', 'ter'];
        $array = Arr::without($array, 'foo', 'bar');
        $this->assertEquals([3 => 'bis', 5 => 'bis', 6 => 'ter'], $array);
        $this->assertNotContains('foo', Arr::without($array, 'foo', 'bar'));
        $this->assertNotContains('bar', Arr::without($array, 'foo', 'bar'));
        // new use case
        $exclusion = ['foo', 'bar'];
        $this->assertNotContains('foo', Arr::without($array, $exclusion));
        $this->assertNotContains('bar', Arr::without($array, $exclusion));
    }

    public function testCanGetcountArray()
    {
        $array = Arr::size([1, 2, 3]);

        $this->assertEquals(3, $array);
    }

    public function testCanSeeIfArrayContainsValue()
    {
        $true = Arr::contains([1, 2, 3], 2);
        $false = Arr::contains([1, 2, 3], 5);

        $this->assertTrue($true);
        $this->assertFalse($false);
    }

    public function testCanCheckIfHasValue()
    {
        $under = Arr::has($this->array, 'foo');

        $this->assertTrue($under);
    }

    public function testCanGetValueFromArray()
    {
        $array = ['foo' => ['bar' => 'bis']];
        $under = Arr::get($array, 'foo.bar');

        $this->assertEquals('bis', $under);
    }

    public function testCantConflictWithNativeFunctions()
    {
        $array = ['foo' => ['bar' => 'bis']];
        $under = Arr::get($array, 'ter', 'str_replace');

        $this->assertEquals('str_replace', $under);
    }

    public function testCanFallbackClosure()
    {
        $array = ['foo' => ['bar' => 'bis']];
        $under = Arr::get($array, 'ter', function () {
            return 'closure';
        });

        $this->assertEquals('closure', $under);
    }

    public function testCanDoSomethingAtEachValue()
    {
        $closure = function ($value, $key) {
            echo $key.':'.$value.':';
        };

        Arr::at($this->array, $closure);
        $result = 'foo:bar:bis:ter:';

        $this->expectOutputString($result);
    }

    public function testCanActOnEachValueFromArray()
    {
        $closure = function ($value, $key) {
            return $key.':'.$value;
        };

        $under = Arr::each($this->array, $closure);
        $result = ['foo' => 'foo:bar', 'bis' => 'bis:ter'];

        $this->assertEquals($result, $under);
    }

    public function testCanFindAValueInAnArray()
    {
        $under = Arr::find($this->arrayNumbers, function ($value) {
            return $value % 2 === 0;
        });
        $this->assertEquals(2, $under);

        $unfound = Arr::find($this->arrayNumbers, function ($value) {
            return $value === 5;
        });
        $this->assertNull($unfound);
    }

    public function testCanFilterValuesFromAnArray()
    {
        $under = Arr::filter($this->arrayNumbers, function ($value) {
            return $value % 2 !== 0;
        });

        $this->assertEquals([0 => 1, 2 => 3], $under);
    }

    public function testCanFilterRejectedValuesFromAnArray()
    {
        $under = Arr::reject($this->arrayNumbers, function ($value) {
            return $value % 2 !== 0;
        });

        $this->assertEquals([1 => 2], $under);
    }

    public function testCanMatchAnArrayContent()
    {
        $under = Arr::matches($this->arrayNumbers, function ($value) {
            return is_int($value);
        });

        $this->assertTrue($under);
    }

    public function testCanMatchPathOfAnArrayContent()
    {
        $under = Arr::matchesAny($this->arrayNumbers, function ($value) {
            return $value === 2;
        });

        $this->assertTrue($under);
    }

    public function testCanInvokeFunctionsOnValues()
    {
        $array = ['   foo  ', '   bar   '];
        $array = Arr::invoke($array, 'trim');

        $this->assertEquals(['foo', 'bar'], $array);
    }

    public function testCanInvokeFunctionsOnValuesWithSingleArgument()
    {
        $array = ['_____foo', '____bar   '];
        $array = Arr::invoke($array, 'trim', ' _');

        $this->assertEquals(['foo', 'bar'], $array);
    }

    public function testCanInvokeFunctionsWithDifferentArguments()
    {
        $array = ['_____foo  ', '__bar   '];
        $array = Arr::invoke($array, 'trim', ['_', ' ']);

        $this->assertEquals(['foo  ', '__bar'], $array);
    }

    public function testCanPluckColumns()
    {
        $under = Arr::pluck($this->arrayMulti, 'foo');
        $matcher = ['bar', 'bar', null];

        $this->assertEquals($matcher, $under);
    }

    public function testCanCalculateAverageValue()
    {
        $average1 = [5, 10, 15, 20];
        $average2 = ['foo', 'b', 'ar'];
        $average3 = [['lol'], 10, 20];

        $average1 = Arr::average($average1);
        $average2 = Arr::average($average2);
        $average3 = Arr::average($average3);

        $this->assertEquals(13, $average1);
        $this->assertEquals(0, $average2);
        $this->assertEquals(10, $average3);
    }

    public function testCanGetFirstValue()
    {
        $under1 = Arr::first($this->array);
        $under2 = Arr::first($this->arrayNumbers, 2);

        $this->assertEquals('bar', $under1);
        $this->assertEquals([1, 2], $under2);
    }

    public function testCanGetLastValue()
    {
        $under = Arr::last($this->array);

        $this->assertEquals('ter', $under);
    }

    public function testCanGetLastElements()
    {
        $under = Arr::last($this->arrayNumbers, 2);

        $this->assertEquals([2, 3], $under);
    }

    public function testCanXInitialElements()
    {
        $under = Arr::initial($this->arrayNumbers, 1);

        $this->assertEquals([1, 2], $under);
    }

    public function testCanGetRestFromArray()
    {
        $under = Arr::rest($this->arrayNumbers, 1);

        $this->assertEquals([2, 3], $under);
    }

    public function testCanCleanArray()
    {
        $array = [false, true, 0, 1, 'full', ''];
        $array = Arr::clean($array);

        $this->assertEquals([1 => true, 3 => 1, 4 => 'full'], $array);
    }

    public function testCanGetMaxValueFromAnArray()
    {
        $under = Arr::max($this->arrayNumbers);

        $this->assertEquals(3, $under);
    }

    public function testCanGetMaxValueFromAnArrayWithClosure()
    {
        $under = Arr::max($this->arrayNumbers, function ($value) {
            return $value * -1;
        });

        $this->assertEquals(-1, $under);
    }

    public function testCanGetMinValueFromAnArray()
    {
        $under = Arr::min($this->arrayNumbers);

        $this->assertEquals(1, $under);
    }

    public function testCanGetMinValueFromAnArrayWithClosure()
    {
        $under = Arr::min($this->arrayNumbers, function ($value) {
            return $value * -1;
        });

        $this->assertEquals(-3, $under);
    }

    public function testCanSortKeys()
    {
        $under = Arr::sortKeys(['z' => 0, 'b' => 1, 'r' => 2]);
        $this->assertEquals(['b' => 1, 'r' => 2, 'z' => 0], $under);

        $under = Arr::sortKeys(['z' => 0, 'b' => 1, 'r' => 2], 'desc');
        $this->assertEquals(['z' => 0, 'r' => 2, 'b' => 1], $under);
    }

    public function testCanSortValues()
    {
        $under = Arr::sort([5, 3, 1, 2, 4], null, 'desc');
        $this->assertEquals([5, 4, 3, 2, 1], $under);

        $under = Arr::sort(range(1, 5), function ($value) {
            return $value % 2 === 0;
        });
        $this->assertEquals([1, 3, 5, 2, 4], $under);
    }

    public function testCanGroupValues()
    {
        $under = Arr::group(range(1, 5), function ($value) {
            return $value % 2 === 0;
        });
        $matcher = [
            [1, 3, 5],
            [2, 4],
        ];

        $this->assertEquals($matcher, $under);
    }

    public function testCanCreateFromRange()
    {
        $range = Arr::range(5);
        $this->assertEquals([1, 2, 3, 4, 5], $range);

        $range = Arr::range(-2, 2);
        $this->assertEquals([-2, -1, 0, 1, 2], $range);

        $range = Arr::range(1, 10, 2);
        $this->assertEquals([1, 3, 5, 7, 9], $range);
    }

    public function testCantChainRange()
    {
        $this->setExpectedException('Exception');

        Arr::from($this->arrayNumbers)->range(5);
    }

    public function testCanCreateFromRepeat()
    {
        $repeat = Arr::repeat('foo', 3);

        $this->assertEquals(['foo', 'foo', 'foo'], $repeat);
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

    public function testCanSearchForAValue()
    {
        $array = Arr::search($this->array, 'ter');

        $this->assertEquals('bis', $array);
    }

    public function testCanRemoveFirstValueFromAnArray()
    {
        $array = Arr::removeFirst($this->array);

        $this->assertEquals(['bis' => 'ter'], $array);
    }

    public function testCanRemoveLasttValueFromAnArray()
    {
        $array = Arr::removeLast($this->array);

        $this->assertEquals(['foo' => 'bar'], $array);
    }

    public function testCanImplodeAnArray()
    {
        $array = Arr::implode($this->array, ',');

        $this->assertEquals('bar,ter', $array);
    }

    public function testCanFlattenArraysToDotNotation()
    {
        $array = [
            'foo' => 'bar',
            'kal' => [
                'foo' => [
                    'bar',
                    'ter',
                ],
            ],
        ];
        $flattened = [
            'foo' => 'bar',
            'kal.foo.0' => 'bar',
            'kal.foo.1' => 'ter',
        ];

        $flatten = Arr::flatten($array);

        $this->assertEquals($flatten, $flattened);
    }

    public function testCanFlattenArraysToCustomNotation()
    {
        $array = [
            'foo' => 'bar',
            'kal' => [
                'foo' => [
                    'bar',
                    'ter',
                ],
            ],
        ];
        $flattened = [
            'foo' => 'bar',
            'kal/foo/0' => 'bar',
            'kal/foo/1' => 'ter',
        ];

        $flatten = Arr::flatten($array, '/');

        $this->assertEquals($flatten, $flattened);
    }

    public function testCanReplaceValues()
    {
        $array = Arr::replace($this->array, 'foo', 'notfoo', 'notbar');
        $matcher = ['notfoo' => 'notbar', 'bis' => 'ter'];

        $this->assertEquals($matcher, $array);
    }

    public function testCanPrependValuesToArrays()
    {
        $array = Arr::prepend($this->array, 'foo');
        $matcher = [0 => 'foo', 'foo' => 'bar', 'bis' => 'ter'];

        $this->assertEquals($matcher, $array);
    }

    public function testCanAppendValuesToArrays()
    {
        $array = Arr::append($this->array, 'foo');
        $matcher = ['foo' => 'bar', 'bis' => 'ter', 0 => 'foo'];

        $this->assertEquals($matcher, $array);
    }

    public function testCanReplaceValuesInArrays()
    {
        $array = $this->array;
        $array = Arr::replaceValue($array, 'bar', 'replaced');

        $this->assertEquals('replaced', $array['foo']);
    }

    public function testCanReplaceKeysInArray()
    {
        $array = $this->array;
        $array = Arr::replaceKeys($array, ['bar', 'ter']);

        $this->assertEquals(['bar' => 'bar', 'ter' => 'ter'], $array);
    }

    public function testCanGetIntersectionOfTwoArrays()
    {
        $a = ['foo', 'bar'];
        $b = ['bar', 'baz'];
        $array = Arr::intersection($a, $b);

        $this->assertEquals(['bar'], $array);
    }

    public function testIntersectsBooleanFlag()
    {
        $a = ['foo', 'bar'];
        $b = ['bar', 'baz'];

        $this->assertTrue(Arr::intersects($a, $b));

        $a = 'bar';
        $this->assertTrue(Arr::intersects($a, $b));
        $a = 'foo';
        $this->assertFalse(Arr::intersects($a, $b));
    }

    public function testFilterBy()
    {
        $a = [
            ['id' => 123, 'name' => 'foo', 'group' => 'primary', 'value' => 123456, 'when' => '2014-01-01'],
            ['id' => 456, 'name' => 'bar', 'group' => 'primary', 'value' => 1468, 'when' => '2014-07-15'],
            ['id' => 499, 'name' => 'baz', 'group' => 'secondary', 'value' => 2365, 'when' => '2014-08-23'],
            ['id' => 789, 'name' => 'ter', 'group' => 'primary', 'value' => 2468, 'when' => '2010-03-01'],
            ['id' => 888,'name' => 'qux','value' => 6868,'when' => '2015-01-01'],
            ['id' => 999,'name' => 'flux','group' => null,'value' => 6868,'when' => '2015-01-01'],
        ];

        $b = Arr::filterBy($a, 'name', 'baz');
        $this->assertCount(1, $b);
        $this->assertEquals(2365, $b[0]['value']);

        $b = Arr::filterBy($a, 'name', ['baz']);
        $this->assertCount(1, $b);
        $this->assertEquals(2365, $b[0]['value']);

        $c = Arr::filterBy($a, 'value', 2468);
        $this->assertCount(1, $c);
        $this->assertEquals('primary', $c[0]['group']);

        $d = Arr::filterBy($a, 'group', 'primary');
        $this->assertCount(3, $d);

        $e = Arr::filterBy($a, 'value', 2000, 'lt');
        $this->assertCount(1, $e);
        $this->assertEquals(1468, $e[0]['value']);

        $e = Arr::filterBy($a, 'value', [2468, 2365], 'contains');
        $this->assertCount(2, $e);
        $this->assertContains(2468, Arr::pluck($e, 'value'));
        $this->assertNotContains(1468, Arr::pluck($e, 'value'));

        $e = Arr::filterBy($a, 'when', '2014-02-01', 'older');
        $this->assertCount(2, $e);
        $this->assertContains('2014-01-01', Arr::pluck($e, 'when'));
        $this->assertContains('2010-03-01', Arr::pluck($e, 'when'));
        $this->assertNotContains('2014-08-23', Arr::pluck($e, 'when'));

        $f = Arr::filterBy($a, 'group', 'primary', 'ne');
        $this->assertCount(3, $f, 'Count should pick up groups which are explicitly set as null AND those which don\'t have the property at all');
        $this->assertContains('qux', Arr::pluck($f, 'name'));
        $this->assertContains('flux', Arr::pluck($f, 'name'));
    }

    public function testFindBy()
    {
        $a = [
            ['id' => 123, 'name' => 'foo', 'group' => 'primary', 'value' => 123456],
            ['id' => 456, 'name' => 'bar', 'group' => 'primary', 'value' => 1468],
            ['id' => 499, 'name' => 'baz', 'group' => 'secondary', 'value' => 2365],
            ['id' => 789, 'name' => 'ter', 'group' => 'primary', 'value' => 2468],
        ];

        $b = Arr::findBy($a, 'name', 'baz');
        $this->assertTrue(is_array($b));
        $this->assertCount(4, $b); // this is counting the number of keys in the array (id,name,group,value)
        $this->assertEquals(2365, $b['value']);
        $this->assertArrayHasKey('name', $b);
        $this->assertArrayHasKey('group', $b);
        $this->assertArrayHasKey('value', $b);

        $c = Arr::findBy($a, 'value', 2468);
        $this->assertTrue(is_array($c));
        $this->assertCount(4, $c);
        $this->assertEquals('primary', $c['group']);

        $d = Arr::findBy($a, 'group', 'primary');
        $this->assertTrue(is_array($d));
        $this->assertCount(4, $d);
        $this->assertEquals('foo', $d['name']);

        $e = Arr::findBy($a, 'value', 2000, 'lt');
        $this->assertTrue(is_array($e));
        $this->assertCount(4, $e);
        $this->assertEquals(1468, $e['value']);
    }

    public function testRemoveValue()
    {
        // numeric array
        $a = ['foo', 'bar', 'baz'];
        $this->assertCount(2, Arr::removeValue($a, 'bar'));
        $this->assertNotContains('bar', Arr::removeValue($a, 'bar'));
        $this->assertContains('foo', Arr::removeValue($a, 'bar'));
        $this->assertContains('baz', Arr::removeValue($a, 'bar'));
        // associative array
        $a = [
            'foo' => 'bar',
            'faz' => 'ter',
            'one' => 'two',
        ];
        $this->assertCount(2, Arr::removeValue($a, 'bar'));
        $this->assertNotContains('bar', array_values(Arr::removeValue($a, 'bar')));
        $this->assertContains('ter', array_values(Arr::removeValue($a, 'bar')));
        $this->assertContains('two', array_values(Arr::removeValue($a, 'bar')));
    }
}
