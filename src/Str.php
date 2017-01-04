<?php
/**
 * Part of the Laradic PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Support;

/**
 * String helper methods
 *
 * @author    Laradic Dev Team
 * @copyright Copyright (c) 2015, Laradic
 * @license   https://tldrlegal.com/license/mit-license MIT License
 * @package   Laradic\Support
 *
 * @method static string namespacedStudly(string $subject) Transforms "vendor-name/package-name" into "VendorName\PackageName"
 * @method static array split(string $subject, $delimiter, int $limit = null) explode
 * @method static string getEncoding(string $subject) Returns the encoding used by the Stringy object.
 * @method static int count(string $subject) Returns the length of the string, implementing the countable interface.
 * @method static \ArrayIterator getIterator(string $subject) Returns a new ArrayIterator, thus implementing the IteratorAggregate interface. The ArrayIterator's constructor is passed an array of chars in the multibyte string. This enables the use of foreach with instances of Stringy\Stringy.
 * @method static boolean offsetExists(string $subject, mixed $offset) Returns whether or not a character exists at an index. Offsets may be negative to count from the last character in the string. Implements part of the ArrayAccess interface.
 * @method static mixed offsetGet(string $subject, mixed $offset) Returns the character at the given index. Offsets may be negative to count from the last character in the string. Implements part of the ArrayAccess interface, and throws an OutOfBoundsException if the index does not exist.
 * @method static mixed offsetSet(string $subject, mixed $offset, mixed $value) Implements part of the ArrayAccess interface, but throws an exception when called. This maintains the immutability of Stringy objects.
 * @method static mixed offsetUnset(string $subject, mixed $offset) Implements part of the ArrayAccess interface, but throws an exception when called. This maintains the immutability of Stringy objects.
 * @method static array chars(string $subject) Returns an array consisting of the characters in the string.
 * @method static string upperCaseFirst(string $subject) Converts the first character of the supplied string to upper case.
 * @method static string lowerCaseFirst(string $subject) Converts the first character of the string to lower case.
 * @method static string camelize(string $subject) Returns a camelCase version of the string. Trims surrounding spaces, capitalizes letters following digits, spaces, dashes and underscores, and removes spaces, dashes, as well as underscores.
 * @method static string upperCamelize(string $subject) Returns an UpperCamelCase version of the supplied string. It trims surrounding spaces, capitalizes letters following digits, spaces, dashes and underscores, and removes spaces, dashes, underscores.
 * @method static string dasherize(string $subject) Returns a lowercase and trimmed string separated by dashes. Dashes are inserted before uppercase characters (with the exception of the first character of the string), and in place of spaces as well as underscores.
 * @method static string underscored(string $subject) Returns a lowercase and trimmed string separated by underscores.
 * @method static string applyDelimiter(string $subject, string $delimiter) Returns a lowercase and trimmed string separated by the given delimiter.
 * @method static string swapCase(string $subject) Returns a case swapped version of the string.
 * @method static string titleize(string $subject, array $ignore = null) Returns a trimmed string with the first letter of each word capitalized.
 * @method static string humanize(string $subject) Capitalizes the first word of the string, replaces underscores with spaces, and strips '_id'.
 * @method static string tidy(string $subject) Returns a string with smart quotes, ellipsis characters, and dashes from Windows-1252 (commonly used in Word documents) replaced by their ASCII equivalents.
 * @method static string collapseWhitespace(string $subject) Trims the string and replaces consecutive whitespace characters with a single space. This includes tabs and newline characters, as well as multibyte whitespace such as the thin space and ideographic space.
 * @method static string toAscii(string $subject, bool $removeUnsupported) Returns an ASCII version of the string. A set of non-ASCII characters are replaced with their closest ASCII counterparts, and the rest are removed unless instructed otherwise.
 * @method static array charsArray(string $subject) Returns the replacements for the toAscii() method.
 * @method static string pad(string $subject, int $length, string $padStr = ' ', string $padType = 'right') Pads the string to a given length with $padStr. If length is less than or equal to the length of the string, no padding takes places. The default string used for padding is a space, and the default type (one of 'left', 'right', 'both') is 'right'. Throws an InvalidArgumentException if $padType isn't one of those 3 values.
 * @method static string padLeft(string $subject, int $length, string $padStr = ' ') Returns a new string of a given length such that the beginning of the string is padded. Alias for pad() with a $padType of 'left'.
 * @method static string padRight(string $subject, int $length, string $padStr = ' ') Returns a new string of a given length such that the end of the string is padded. Alias for pad() with a $padType of 'right'.
 * @method static string padBoth(string $subject, int $length, string $padStr = ' ') Returns a new string of a given length such that both sides of the string are padded. Alias for pad() with a $padType of 'both'.
 * @method static string applyPadding(string $subject, int $left, int $right, string $padStr = ' ') Adds the specified amount of left and right padding to the given string.
 * @method static bool startsWith(string $subject, string $substring, bool $caseSensitive = true) Returns true if the string begins with $substring, false otherwise. By default, the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
 * @method static bool endsWith(string $subject, string $substring, bool $caseSensitive = true) Returns true if the string ends with $substring, false otherwise. By default, the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
 * @method static string toSpaces(string $subject, int $tabLength) Converts each tab in the string to some number of spaces, as defined by $tabLength. By default, each tab is converted to 4 consecutive spaces.
 * @method static string toTabs(string $subject, int $tabLength) Converts each occurrence of some consecutive number of spaces, as defined by $tabLength, to a tab. By default, each 4 consecutive spaces are converted to a tab.
 * @method static string toTitleCase(string $subject) Converts the first character of each word in the string to uppercase.
 * @method static string toLowerCase(string $subject) Converts all characters in the string to lowercase. An alias for PHP's mb_strtolower().
 * @method static string toUpperCase(string $subject) Converts all characters in the string to uppercase. An alias for PHP's mb_strtoupper().
 * @method static string slugify(string $subject, string $replacement = '-') Converts the string into an URL slug. This includes replacing non-ASCII characters with their closest ASCII equivalents, removing remaining non-ASCII and non-alphanumeric characters, and replacing whitespace with $replacement. The replacement defaults to a single dash, and the string is also converted to lowercase.
 * @method static bool contains(string $subject, string $needle, bool $caseSensitive = false) Returns true if the string contains $needle, false otherwise. By default the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
 * @method static bool containsAny(string $subject, array $needles, bool $caseSensitive) Returns true if the string contains any $needles, false otherwise. By default the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
 * @method static bool containsAll(string $subject, array $needles, bool $caseSensitive) Returns true if the string contains all $needles, false otherwise. By default the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false.
 * @method static string surround(string $subject, string $substring) Surrounds $str with the given substring.
 * @method static string insert(string $subject, string $substring, int $index) Inserts $substring into the string at the $index provided.
 * @method static string truncate(string $subject, int $length, string $substring = '') Truncates the string to a given length. If $substring is provided, and truncating occurs, the string is further truncated so that the substring may be appended without exceeding the desired length.
 * @method static string safeTruncate(string $subject, int $length, string $substring = '') Truncates the string to a given length, while ensuring that it does not split words. If $substring is provided, and truncating occurs, the string is further truncated so that the substring may be appended without exceeding the desired length.
 * @method static string reverse(string $subject) Returns a reversed string. A multibyte version of strrev().
 * @method static string shuffle(string $subject) A multibyte str_shuffle() function. It returns a string with its characters in random order.
 * @method static string trim(string $subject) Returns the trimmed string. An alias for PHP's trim() function.
 * @method static string longestCommonPrefix(string $subject, string $otherStr) Returns the longest common prefix between the string and $otherStr.
 * @method static string longestCommonSuffix(string $subject, string $otherStr) Returns the longest common suffix between the string and $otherStr.
 * @method static string longestCommonSubstring(string $subject, string $otherStr) Returns the longest common substring between the string and $otherStr.
 * @method static int length(string $subject) Returns the length of the string. An alias for PHP's mb_strlen() function.
 * @method static string substr(string $subject, int $start, int $length = null) Returns the substring beginning at $start with the specified $length.
 * @method static string at(string $subject, int $index) Returns the character at $index, with indexes starting at 0.
 * @method static string first(string $subject, int $n) Returns the first $n characters of the string.
 * @method static string last(string $subject, int $n) Returns the last $n characters of the string.
 * @method static string ensureLeft(string $subject, string $substring) Ensures that the string begins with $substring. If it doesn't, it's prepended.
 * @method static string ensureRight(string $subject, string $substring) Ensures that the string begins with $substring. If it doesn't, it's appended.
 * @method static string removeLeft(string $subject, string $substring) Returns a new string with the prefix $substring removed, if present.
 * @method static string removeRight(string $subject, string $substring) Returns a new string with the suffix $substring removed, if present.
 * @method static bool matchesPattern(string $subject, string $pattern) Returns true if $str matches the supplied pattern, false otherwise.
 * @method static bool hasLowerCase(string $subject) Returns true if the string contains a lower case char, false otherwise.
 * @method static bool hasUpperCase(string $subject) Returns true if the string contains an upper case char, false otherwise.
 * @method static bool isAlpha(string $subject) Returns true if the string contains only alphabetic chars, false otherwise.
 * @method static bool isAlphanumeric(string $subject) Returns true if the string contains only alphabetic and numeric chars, false otherwise.
 * @method static bool isHexadecimal(string $subject) Returns true if the string contains only hexadecimal chars, false otherwise.
 * @method static bool isBlank(string $subject) Returns true if the string contains only whitespace chars, false otherwise.
 * @method static bool isJson(string $subject) Returns true if the string is JSON, false otherwise.
 * @method static bool isLowerCase(string $subject) Returns true if the string contains only lower case chars, false otherwise.
 * @method static bool isUpperCase(string $subject) Returns true if the string contains only lower case chars, false otherwise.
 * @method static bool isSerialized(string $subject) Returns true if the string is serialized, false otherwise.
 * @method static int countSubstr(string $subject, string $substring, bool $caseSensitive) Returns the number of occurrences of $substring in the given string.
 * @method static string replace(string $subject, string $search, string $replacement) Replaces all occurrences of $search in $str by $replacement.
 * @method static string regexReplace(string $subject, string $pattern, string $replacement, string $options = 'msr') Replaces all occurrences of $pattern in $str by $replacement. An alias for mb_ereg_replace(). Note that the 'i' option with multibyte patterns in mb_ereg_replace() requires PHP 5.4+. This is due to a lack of support in the bundled version of Oniguruma in PHP 5.3.
 * @mixin \Underscore\Methods\StringsMethods
 * @mixin \Illuminate\Support\Str
 */
class Str
{
    /**
     * Get the instance of Stringy.
     *
     * @param  array $arguments
     *
     * @return Stringy
     */
    public function getStringyString($arguments)
    {
        return forward_static_call(__NAMESPACE__ . '\\Vendor\\Stringy::create', head($arguments));
    }

    /**
     * Create a new PHP Underscore string instance.
     *
     * @param  string $string
     *
     * @return static
     */
    public static function from($string = null)
    {
        return forward_static_call('Underscore\\Types\\Strings::from', $string);
    }

    /**
     * Create a new Stringy string instance.
     *
     * @param  string $string
     *
     * @return \Laradic\Support\Vendor\Stringy
     */
    public static function create($string)
    {
        return forward_static_call(__NAMESPACE__ . '\\Vendor\\Stringy::create', $string);
    }

    /**
     * Magic call method.
     *
     * @param  string $name
     * @param  mixed  $parameters
     *
     * @return mixed
     */
    public function __call($name, $parameters)
    {
        $reflect = null;

        $c = new \ReflectionClass('Underscore\\Methods\\StringsMethods');
        if ($c->hasMethod($name)) {
            return forward_static_call_array([ 'Underscore\\Methods\\StringsMethods', $name ], $parameters);
        } elseif (class_exists('Illuminate\\Support\\Str') && method_exists('Illuminate\\Support\\Str', $name)) {
            return forward_static_call_array([ 'Illuminate\\Support\\Str', $name ], $parameters);
        } elseif (class_exists('Underscore\\Methods\\StringsMethods') && method_exists('Underscore\\Methods\\StringsMethods', $name) && !is_null($reflect) && $reflect->isPublic()) {
            return forward_static_call_array([ 'Underscore\\Types\\Strings', $name ], $parameters);
        } elseif (class_exists('Stringy\\Stringy')) {
            $object = $this->getStringyString($parameters);
            if (method_exists($object, $name)) {
                return (string)call_user_func_array([ $object, $name ], array_slice($parameters, 1));
            }
        }
        throw new \BadMethodCallException("could not call [$name]. Do you have underscore and stringy installed?");
    }

    /**
     * Magic call static method.
     *
     * @param  string $name
     * @param  mixed  $parameters
     *
     * @return mixed
     */
    public static function __callStatic($name, $parameters)
    {
        return call_user_func_array([ new static(), $name ], $parameters);
    }


    public static function getExceptionTraceAsString(\Throwable $exception)
    {
        $rtn   = "";
        $count = 0;
        foreach ($exception->getTrace() as $frame) {
            $args = "";
            if (isset($frame[ 'args' ])) {
                $args = [ ];
                foreach ($frame[ 'args' ] as $arg) {
                    if (is_string($arg)) {
                        $args[] = "'" . $arg . "'";
                    } elseif (is_array($arg)) {
                        $args[] = "Array";
                    } elseif (is_null($arg)) {
                        $args[] = 'NULL';
                    } elseif (is_bool($arg)) {
                        $args[] = ($arg) ? "true" : "false";
                    } elseif (is_object($arg)) {
                        $args[] = get_class($arg);
                    } elseif (is_resource($arg)) {
                        $args[] = get_resource_type($arg);
                    } else {
                        $args[] = $arg;
                    }
                }
                $args = join(", ", $args);
            }
            $rtn .= sprintf(
                "#%s %s(%s): %s(%s)\n",
                $count,
                isset($frame[ 'file' ]) ? $frame[ 'file' ] : '',
                isset($frame[ 'line' ]) ? $frame[ 'line' ] : '',
                $frame[ 'function' ],
                $args
            );
            $count++;
        }
        return $rtn;
    }
}
