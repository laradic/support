<?php
namespace Laradic\Tests\Support;

use Laradic\Support\Str;

class StrTest extends TestCase
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


    public $remove = 'foo foo bar foo kal ter son';

    public function provideAccord()
    {
        return [
            [10, '10 things'],
            [1, 'one thing'],
            [0, 'nothing'],
        ];
    }

    public function provideFind()
    {
        return [

            // Simple cases
            [false, 'foo', 'bar'],
            [true, 'foo', 'foo'],
            [true, 'FOO', 'foo', false],
            [false, 'FOO', 'foo', true],
            // Many needles, one haystack
            [true, ['foo', 'bar'], $this->remove],
            [false, ['vlu', 'bla'], $this->remove],
            [true, ['foo', 'vlu'], $this->remove, false, false],
            [false, ['foo', 'vlu'], $this->remove, false, true],
            // Many haystacks, one needle
            [true, 'foo', ['foo', 'bar']],
            [true, 'bar', ['foo', 'bar']],
            [false, 'foo', ['bar', 'kal']],
            [true, 'foo', ['foo', 'foo'], false, false],
            [false, 'foo', ['foo', 'bar'], false, true],
        ];
    }

    // Tests --------------------------------------------------------- /

    public function testCanCreateString()
    {
        $string = Str::from();

        $this->assertEquals('', $string->obtain());
    }


    /**
     * Test the Str::words method.
     *
     * @group laravel
     */
    public function testStringCanBeLimitedByWords()
    {
        $this->assertEquals('Taylor...', Str::words('Taylor Otwell', 1));
        $this->assertEquals('Taylor___', Str::words('Taylor Otwell', 1, '___'));
        $this->assertEquals('Taylor Otwell', Str::words('Taylor Otwell', 3));
    }
    public function testStringTrimmedOnlyWhereNecessary()
    {
        $this->assertEquals(' Taylor Otwell ', Str::words(' Taylor Otwell ', 3));
        $this->assertEquals(' Taylor...', Str::words(' Taylor Otwell ', 1));
    }
    public function testStringTitle()
    {
        $this->assertEquals('Jefferson Costella', Str::title('jefferson costella'));
        $this->assertEquals('Jefferson Costella', Str::title('jefFErson coSTella'));
    }
    public function testStringWithoutWordsDoesntProduceError()
    {
        $nbsp = chr(0xC2).chr(0xA0);
        $this->assertEquals(' ', Str::words(' '));
        $this->assertEquals($nbsp, Str::words($nbsp));
    }
    public function testStartsWith()
    {
        $this->assertTrue(Str::startsWith('jason', 'jas', true));
        $this->assertTrue(Str::startsWith('jason', 'jason', true));
        $this->assertTrue(Str::startsWith('jason', ['jas'], true));
        $this->assertFalse(Str::startsWith('jason ', 'day', true));
        $this->assertFalse(Str::startsWith('jason', ['day'], true));
        $this->assertFalse(Str::startsWith('jason', '', true));
    }
    public function testEndsWith()
    {
        $this->assertTrue(Str::endsWith('jason', 'on'));
        $this->assertTrue(Str::endsWith('jason', 'jason'));
        $this->assertTrue(Str::endsWith('jason', ['on']));
        $this->assertFalse(Str::endsWith('jason', 'no'));
        $this->assertFalse(Str::endsWith('jason', ['no']));
        $this->assertFalse(Str::endsWith('jason', ''));
        $this->assertFalse(Str::endsWith('7', ' 7'));
    }
    public function testStrContains()
    {
        $this->assertTrue(Str::contains('taylor', 'ylo'));
        $this->assertTrue(Str::contains('taylor', ['ylo']));
        $this->assertFalse(Str::contains('taylor', 'xxx'));
        $this->assertFalse(Str::contains('taylor', ['xxx']));
        $this->assertFalse(Str::contains('taylor', ''));
    }


    public function testFinish()
    {
        $this->assertEquals('abbc', Str::finish('ab', 'bc'));
        $this->assertEquals('abbc', Str::finish('abbcbc', 'bc'));
        $this->assertEquals('abcbbc', Str::finish('abcbbcbc', 'bc'));
    }
    public function testIs()
    {
        $this->assertTrue(Str::is('/', '/'));
        $this->assertFalse(Str::is('/', ' /'));
        $this->assertFalse(Str::is('/', '/a'));
        $this->assertTrue(Str::is('foo/*', 'foo/bar/baz'));
        $this->assertTrue(Str::is('*/foo', 'blah/baz/foo'));
    }
    public function testLower()
    {
        $this->assertEquals('foo bar baz', Str::lower('FOO BAR BAZ'));
        $this->assertEquals('foo bar baz', Str::lower('fOo Bar bAz'));
    }
    public function testUpper()
    {
        $this->assertEquals('FOO BAR BAZ', Str::upper('foo bar baz'));
        $this->assertEquals('FOO BAR BAZ', Str::upper('foO bAr BaZ'));
    }

    public function testLength()
    {
        $this->assertEquals(11, Str::length('foo bar baz'));
    }
    public function testQuickRandom()
    {
        $randomInteger = mt_rand(1, 100);
        $this->assertEquals($randomInteger, strlen(Str::quickRandom($randomInteger)));
        $this->assertInternalType('string', Str::quickRandom());
        $this->assertEquals(16, strlen(Str::quickRandom()));
    }
    public function testRandom()
    {
        $this->assertEquals(16, strlen(Str::random()));
        $randomInteger = mt_rand(1, 100);
        $this->assertEquals($randomInteger, strlen(Str::random($randomInteger)));
        $this->assertInternalType('string', Str::random());
    }
    public function testSnake()
    {
        $this->assertEquals('laravel_p_h_p_framework', Str::snake('LaravelPHPFramework'));
        $this->assertEquals('laravel_php_framework', Str::snake('LaravelPhpFramework'));
        $this->assertEquals('laravel_php_framework', Str::snake('Laravel Php Framework'));
        $this->assertEquals('laravel_php_framework', Str::snake('Laravel    Php      Framework   '));
    }

    public function testCanToggleBetweenTwoStrings()
    {
        $toggle = Str::toggle('foo', 'foo', 'bar');
        $this->assertEquals('bar', $toggle);
    }

    public function testCannotLooselyToggleBetweenStrings()
    {
        $toggle = Str::toggle('dei', 'foo', 'bar');
        $this->assertEquals('dei', $toggle);
    }

    public function testCanLooselyToggleBetweenStrings()
    {
        $toggle = Str::toggle('dei', 'foo', 'bar', true);
        $this->assertEquals('foo', $toggle);
    }

    public function testCanRepeatString()
    {
        $string = Str::from('foo')->repeat(3)->obtain();

        $this->assertEquals('foofoofoo', $string);
    }

    /**
     * @dataProvider provideFind
     */
    public function testCanFindStringsInStrings(
        $expect,
        $needle,
        $haystack,
        $caseSensitive = false,
        $absoluteFinding = false
    ) {
        $result = Str::find($haystack, $needle, $caseSensitive, $absoluteFinding);

        $this->assertEquals($expect, $result);
    }

    public function testCanAssertAStringStartsWith()
    {
        $this->assertTrue(Str::startsWith('foobar', 'foo'));
        $this->assertFalse(Str::startsWith('barfoo', 'foo'));
    }

    public function testCanAssertAStringEndsWith()
    {
        $this->assertTrue(Str::endsWith('foobar', 'bar'));
        $this->assertFalse(Str::endsWith('barfoo', 'bar'));
    }

    public function testStringsCanBeSlugged()
    {
        $this->assertEquals('my-new-post', Str::slugify('My_nEw\\\/  @ post!!!'));
        $this->assertEquals('my_new_post', Str::slugify('My nEw post!!!', '_'));
    }

    public function testRandomStringsCanBeGenerated()
    {
        $this->assertEquals(40, strlen(Str::random(40)));
    }

    /**
     * @dataProvider provideAccord
     */
    public function testCanAccordAStringToItsNumeral($number, $expect)
    {
        $result = Str::accord($number, '%d things', 'one thing', 'nothing');

        $this->assertEquals($expect, $result);
    }

    public function testCanSliceFromAString()
    {
        $string = Str::sliceFrom('abcdef', 'c');

        return $this->assertEquals('cdef', $string);
    }

    public function testCanSliceToAString()
    {
        $string = Str::sliceTo('abcdef', 'c');

        return $this->assertEquals('ab', $string);
    }

    public function testCanSliceAString()
    {
        $string = Str::slice('abcdef', 'c');

        return $this->assertEquals(['ab', 'cdef'], $string);
    }

    public function testCanUseCorrectOrderForStrReplace()
    {
        $string = Str::replace('foo', 'foo', 'bar');

        $this->assertEquals('bar', $string);
    }

    public function testCanExplodeString()
    {
        $string = Str::explode('foo bar foo', ' ');
        $this->assertEquals(['foo', 'bar', 'foo'], $string);

        $string = Str::explode('foo bar foo', ' ', -1);
        $this->assertEquals(['foo', 'bar'], $string);
    }

    public function testCanGenerateRandomWords()
    {
        $string = Str::randomStrings($words = 5, $size = 5);

        $result = ($words * $size) + ($words * 1) - 1;
        $this->assertEquals($result, strlen($string));
    }

    public function testCanConvertToSnakeCase()
    {
        $string = Str::toSnakeCase('thisIsAString');

        $this->assertEquals('this_is_a_string', $string);
    }

    public function testCanConvertToCamelCase()
    {
        $string = Str::toCamelCase('this_is_a_string');

        $this->assertEquals('thisIsAString', $string);
    }

    public function testCanConvertToPascalCase()
    {
        $string = Str::toPascalCase('this_is_a_string');

        $this->assertEquals('ThisIsAString', $string);
    }

    public function testCanConvertToLowercase()
    {
        $this->assertEquals('taylor', Str::lower('TAYLOR'));
        $this->assertEquals('άχιστη', Str::lower('ΆΧΙΣΤΗ'));
    }

    public function testCanConvertToUppercase()
    {
        $this->assertEquals('TAYLOR', Str::upper('taylor'));
        $this->assertEquals('ΆΧΙΣΤΗ', Str::upper('άχιστη'));
    }

    public function testCanConvertToTitleCase()
    {
        $this->assertEquals('Taylor', Str::title('taylor'));
        $this->assertEquals('Άχιστη', Str::title('άχιστη'));
    }

    public function testCanLimitStringsByCharacters()
    {
        $this->assertEquals('Tay...', Str::limit('Taylor', 3));
        $this->assertEquals('Taylor', Str::limit('Taylor', 6));
        $this->assertEquals('Tay___', Str::limit('Taylor', 3, '___'));
    }

    public function testCanLimitByWords()
    {
        $this->assertEquals('Taylor...', Str::words('Taylor Otwell', 1));
        $this->assertEquals('Taylor___', Str::words('Taylor Otwell', 1, '___'));
        $this->assertEquals('Taylor Otwell', Str::words('Taylor Otwell', 3));
    }

    public function testCanCheckIfIsIp()
    {
        $this->assertTrue(Str::isIp('192.168.1.1'));
        $this->assertFalse(Str::isIp('foobar'));
    }

    public function testCanCheckIfIsEmail()
    {
        $this->assertTrue(Str::isEmail('foo@bar.com'));
        $this->assertFalse(Str::isEmail('foobar'));
    }

    public function testCanCheckIfIsUrl()
    {
        $this->assertTrue(Str::isUrl('http://www.foo.com/'));
        $this->assertFalse(Str::isUrl('foobar'));
    }

    public function testCanPrependString()
    {
        $this->assertEquals('foobar', Str::prepend('bar', 'foo'));
    }

    public function testCanAppendString()
    {
        $this->assertEquals('foobar', Str::append('foo', 'bar'));
    }

    public function testCanGetBaseClass()
    {
        $this->assertEquals('Baz', Str::baseClass('Foo\Bar\Baz'));
    }
}
