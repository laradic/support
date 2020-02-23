<?php


namespace Illuminate\Filesystem {

    /**
     * @method void ensureDirectory($path, $mode=0755)
     * @method string[] rglob($pattern, $flag=0)
     */
    class Filesystem {}
}
namespace Illuminate\Support {

    use ByteUnits\Binary;
    use ByteUnits\Metric;
    use Laradic\Support\Dot;

    /**
     * @template T
     * @mixin \Illuminate\Support\Collection
     * @property \Symfony\Component\ExpressionLanguage\Expression $_exl
     * @method $this|static evaluate($expression, $method = 'each', array $vars = [])
     * @method Dot toDot()
     * @method bool hasString($string, bool $useKey = false)
     * @method bool hasMatchingString($pattern, bool $useKey = false)
     * @method $this matchingString($pattern, bool $useKey = false)
     * @method mixed loadInto(string $target)
     * @method $this cast(string $to)
     * @method $this call(callable $callable, $parameters = [], $addKeyAsParameter = true)
     * @method $this pushTo(string $key, $value, bool $allowDuplicates = false)
     * @method mixed dataGet($key, $default=null)
     * @method $this dataSet($key, $value, $overwrite=true)
     * @method withSize(int $size)        Create a new collection with the specified amount of items.
     * @method transpose()        Transpose an array.
     * @method \Illuminate\Support\Collection collect(mixed  $key, mixed  $default=null)        Get a new collection from the collection by key.
     * @method fromPairs()        Transform a collection into an associative array form collection item.
     * @method sliceBefore(callable $callback, bool $preserveKeys)        Slice a collection before a given callback is met into separate chunks.
     * @method extract()        Extract keys from a collection, like `only`, except:- If a value doesn't exist, it returns null instead of omitting it- It returns a collection without keys, so `list()` can be used.
     * @method validate(string|callable $callback)        Returns true if $callback returns true for every item. If $callbackis a string or an array, regard it as a validation rule.
     * @method rotate(int $offset)        Rotate the items in the collection with given offset.
     * @method sixth()
     * @method ifEmpty(callable $callback)        Execute a callable if the collection is empty, then return the collection.
     * @method groupByModel(string|callable $callback, bool $preserveKeys, mixed $modelKey, mixed $itemsKey)        Group a collection by an Eloquent model.
     * @method second()
     * @method eighth()
     * @method $this setItems($items = [])
     * @method eachCons(int $chunkSize, bool $preserveKeys)        Get the consecutive values in the collection defined by the given chunk size.
     * @method fourth()
     * @method toPairs()        Transform a collection into an an array with pairs.
     * @method chunkBy(callable $callback, bool $preserveKeys)        Separate a collection into chunks as long as the given callback returns true.
     * @method before()
     * @method tail(bool $preserveKeys)        Get the tail of a collection, everything except the first item.
     * @method sectionBy(mixed $key, bool $preserveKeys, mixed $sectionKey, mixed $itemsKey)        Splits a collection into sections grouped by a given key.
     * @method firstOrFail()        Get the first item. Throws CollectionItemNotFound if the item was not found.
     * @method prioritize(callable  $callable)        Move elements to the start of the collection.
     * @method ifAny(callable $callback)        Execute a callable if the collection isn't empty, then return the collection.
     * @method pluckToArray(string|array  $value, string|null  $key)        Get the array of values of a given key.
     * @method parallelMap(callable $callback)        Idential to map but each item will be processed in parallel.This function requires the installation of amphp/parallel-functions
     * @method paginate(int $perPage, int $total, int $page, string $pageName)        Paginate the given collection.
     * @method fifth()
     * @method at(mixed $index)        Get a single item from the collection by index.
     * @method none(mixed $key, mixed $value)        Check whether a collection doesn't contain any occurrences of a givenitem, key-value pair, or passing truth test. `none` accepts the sameparameters as the `contains` collection method.
     * @method seventh()
     * @method glob(callable $callback)        Execute a callable if the collection isn't empty, then return the collection.
     * @method tenth()
     * @method simplePaginate(int $perPage, int $page, string $pageName)        Paginate the collection into a simple paginator.
     * @method third()
     * @method ninth()
     * @method filterMap(callable $callback)        Map a collection, then filter the results.
     * @method head()        Get the first item from the collection.
     * @method after(mixed $currentItem, mixed $fallback)        Get the next item from the collection.
     */
    class Collection
    {
    }


    /**
     * @method static string ancronym(string $str)
     * @method static string append(string $str, string $stringAppend, string $encoding = null)
     * @method static string at(string $str, int $index, string $encoding = null)
     * @method static string between(string $str, string $start, string $end, int $offset = 0, string $encoding = null)
     * @method static string camelize(string $str, string $encoding = null)
     * @method static string chars(string $str, string $encoding = null)
     * @method static string collapseWhitespace(string $str, string $encoding = null)
     * @method static bool contains(string $str, string $needle, bool $caseSensitive = true, string $encoding = null)
     * @method static bool containsAll(string $str, string[] $needle, bool $caseSensitive = true, string $encoding = null)
     * @method static bool containsAny(string $str, string[] $needle, bool $caseSensitive = true, string $encoding = null)
     * @method static int count(string $str, string $encoding = null)
     * @method static int countSubstr(string $str, string $substring, bool $caseSensitive = true, string $encoding = null)
     * @method static string dasherize(string $str, string $encoding = null)
     * @method static string delimit(string $str, string $delimiter, string $encoding = null)
     * @method static bool endsWith(string $str, string $substring, bool $caseSensitive = true, string $encoding = null)
     * @method static bool endsWithAny(string $str, string[] $substrings, bool $caseSensitive = true, string $encoding = null)
     * @method static string ensureLeft(string $str, string $substring, string $encoding = null)
     * @method static string ensureRight(string $str, string $substring, string $encoding = null)
     * @method static string first(string $str, int $n, string $encoding = null)
     * @method static bool hasLowerCase(string $str, string $encoding = null)
     * @method static bool hasUpperCase(string $str, string $encoding = null)
     * @method static string htmlDecode(string $str, int $flags = ENT_COMPAT, string $encoding = null)
     * @method static string htmlEncode(string $str, int $flags = ENT_COMPAT, string $encoding = null)
     * @method static string humanize(string $str, string $encoding = null)
     * @method static int indexOf(string $str, string $needle, int $offset = 0, string $encoding = null)
     * @method static int indexOfLast(string $str, string $needle, int $offset = 0, string $encoding = null)
     * @method static string insert(string $str, string $substring, int $index = 0, string $encoding = null)
     * @method static bool isAlpha(string $str, string $encoding = null)
     * @method static bool isAlphanumeric(string $str, string $encoding = null)
     * @method static bool isBase64(string $str, string $encoding = null)
     * @method static bool isBlank(string $str, string $encoding = null)
     * @method static bool isHexadecimal(string $str, string $encoding = null)
     * @method static bool isJson(string $str, string $encoding = null)
     * @method static bool isLowerCase(string $str, string $encoding = null)
     * @method static bool isSerialized(string $str, string $encoding = null)
     * @method static bool isUpperCase(string $str, string $encoding = null)
     * @method static string last(string $str, string $encoding = null)
     * @method static int length(string $str, string $encoding = null)
     * @method static string[] lines(string $str, string $encoding = null)
     * @method static string longestCommonPrefix(string $str, string $otherStr, string $encoding = null)
     * @method static string longestCommonSuffix(string $str, string $otherStr, string $encoding = null)
     * @method static string longestCommonSubstring(string $str, string $otherStr, string $encoding = null)
     * @method static string lowerCaseFirst(string $str, string $encoding = null)
     * @method static string pad(string $str, int $length, string $padStr = ' ', string $padType = 'right', string $encoding = null)
     * @method static string padBoth(string $str, int $length, string $padStr = ' ', string $encoding = null)
     * @method static string padLeft(string $str, int $length, string $padStr = ' ', string $encoding = null)
     * @method static string padRight(string $str, int $length, string $padStr = ' ', string $encoding = null)
     * @method static string prepend(string $str, string $string, string $encoding = null)
     * @method static string regexReplace(string $str, string $pattern, string $replacement, string $options = 'msr', string $encoding = null)
     * @method static string removeLeft(string $str, string $substring, string $encoding = null)
     * @method static string removeRight(string $str, string $substring, string $encoding = null)
     * @method static string repeat(string $str, int $multiplier, string $encoding = null)
     * @method static string replace(string $str, string $search, string $replacement, string $encoding = null)
     * @method static string reverse(string $str, string $encoding = null)
     * @method static string safeTruncate(string $str, int $length, string $substring = '', string $encoding = null)
     * @method static string shuffle(string $str, string $encoding = null)
     * @method static string slugify(string $str, string $replacement = '-', string $encoding = null)
     * @method static string slice(string $str, int $start, int $end = null, string $encoding = null)
     * @method static string split(string $str, string $pattern, int $limit = null, string $encoding = null)
     * @method static bool startsWith(string $str, string $substring, bool $caseSensitive = true, string $encoding = null)
     * @method static bool startsWithAny(string $str, string[] $substrings, bool $caseSensitive = true, string $encoding = null)
     * @method static string stripWhitespace(string $str, string $encoding = null)
     * @method static string substr(string $str, int $start, int $length = null, string $encoding = null)
     * @method static string surround(string $str, string $substring, string $encoding = null)
     * @method static string swapCase(string $str, string $encoding = null)
     * @method static string tidy(string $str, string $encoding = null)
     * @method static string titleize(string $str, string $encoding = null)
     * @method static string toAscii(string $str, string $language = 'en', bool $removeUnsupported = true, string $encoding = null)
     * @method static bool toBoolean(string $str, string $encoding = null)
     * @method static string toLowerCase(string $str, string $encoding = null)
     * @method static string toSpaces(string $str, int $tabLength = 4, string $encoding = null)
     * @method static string toTabs(string $str, int $tabLength = 4, string $encoding = null)
     * @method static string toTitleCase(string $str, string $encoding = null)
     * @method static string toUpperCase(string $str, string $encoding = null)
     * @method static string trim(string $str, string $chars = null, string $encoding = null)
     * @method static string trimLeft(string $str, string $chars = null, string $encoding = null)
     * @method static string trimRight(string $str, string $chars = null, string $encoding = null)
     * @method static string truncate(string $str, int $length, string $substring = '', string $encoding = null)
     * @method static string underscored(string $str, string $encoding = null)
     * @method static string upperCamelize(string $str, string $encoding = null)
     * @method static string upperCaseFirst(string $str, string $encoding = null)
     * @method static Metric bytes(string|int $bytes)
     * @method static Metric bytesMetric(string|int $bytes)
     * @method static Binary bytesBinary(string|int $bytes)
     * @method static Metric parseBytes(string|int $bytes)
     * @method static Metric parseBytesMetric(string|int $bytes)
     * @method static Binary parseBytesBinary(string|int $bytes)
     *
     */
    class Str
    {
    }

    /**
     * @method static array merge(array $arr1, array $arr2, bool $unique = true)
     */
    class Arr
    {
    }
}
