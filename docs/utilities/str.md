<!---
title: Str
subtitle: Utilities
author: Robin Radic
-->

| Method | Description |
|:-------|:------------|
| `namespacedStudly` | Studly Namespace |
| `split($delimiter,$limit=null)` | Explode a string into an array |
| `startsWith($substring,$caseSensitive=true)` | {@inheritdoc} | 
| `getEncoding` | Returns the encoding used by the Stringy object. |
| `count` | Returns the length of the string, implementing the countable interface. | 
| `offsetExists($offset)` | Returns whether or not a character exists at an index.  |
| `offsetGet($offset)` | Returns the character at the given index.  |
| `offsetSet($offset,$value)` | Implements part of the ArrayAccess interface, but throws an exception when called. This maintains the immutability of Stringy objects. |
| `offsetUnset($offset)` | Implements part of the ArrayAccess interface, but throws an exception when called. This maintains the immutability of Stringy objects. |
| `chars` | Returns an array consisting of the characters in the string. |
| `upperCaseFirst` | Converts the first character of the supplied string to upper case. |
| `lowerCaseFirst` | Converts the first character of the string to lower case. |
| `camelize` | Returns a camelCase version of the string.  |
| `upperCamelize` | Returns an UpperCamelCase version of the supplied string. |
| `dasherize` | Returns a lowercase and trimmed string separated by dashes.  |
| `underscored` | Returns a lowercase and trimmed string separated by underscores. |
| `applyDelimiter($delimiter)` | Returns a lowercase and trimmed string separated by the given delimiter. |
| `swapCase` | Returns a case swapped version of the string. |
| `titleize($ignore=null)` | Returns a trimmed string with the first letter of each word capitalized. |
| `humanize` | Capitalizes the first word of the string, replaces underscores with spaces, and strips |
| `tidy` | Returns a string with smart quotes, ellipsis characters, and dashes replaced by their ASCII equivalents. |
| `collapseWhitespace` | Trims the string and replaces consecutive whitespace characters  |
| `toAscii($removeUnsupported=true)` | Returns an ASCII version of the string. |
| `charsArray` | Returns the replacements for the toAscii() method. |
| `pad($length,$padStr= ,$padType=right)` | Pads the string to a given length with $padStr.  |
| `padLeft($length,$padStr= )` | Returns a new string of a given length such that the beginning of the string is padded. Alias for pad() with a $padType of 'left'. |
| `padRight($length,$padStr= )` | Returns a new string of a given length such that the end of the string is padded. Alias for pad() with a $padType of 'right'. |
| `padBoth($length,$padStr= )` | Returns a new string of a given length such that both sides of the string are padded. Alias for pad() with a $padType of 'both'. |
| `applyPadding($left=0,$right=0,$padStr= )` | Adds the specified amount of left and right padding to the given string. |
| `endsWith($substring,$caseSensitive=true)` | Returns true if the string ends with $substring, false otherwise. By default, the comparison is case-sensitive, but can be made insensitive by setting $caseSensitive to false. |
| `toSpaces($tabLength=4)` | Converts each tab in the string to some number of spaces, as defined by $tabLength. By default, each tab is converted to 4 consecutive spaces. |
| `toTabs($tabLength=4)` | Converts each occurrence of some consecutive number of spaces, as defined by $tabLength, to a tab. By default, each 4 consecutive spaces are converted to a tab. |
| `toTitleCase` | Converts the first character of each word in the string to uppercase. |
| `toLowerCase` | Converts all characters in the string to lowercase. An alias for PHP's mb_strtolower(). |
| `toUpperCase` | Converts all characters in the string to uppercase. An alias for PHP's mb_strtoupper(). |
| `slugify($replacement=-)` | Converts the string into an URL slug.  |
| `contains($needle,$caseSensitive=true)` | Returns true if the string contains $needle, false otherwise |
| `containsAny($needles,$caseSensitive=true)` | Returns true if the string contains any $needles, false otherwise. |
| `containsAll($needles,$caseSensitive=true)` | Returns true if the string contains all $needles, false otherwise.  |
| `surround($substring)` | Surrounds $str with the given substring. |
| `insert($substring,$index)` | Inserts $substring into the string at the $index provided. |
| `truncate($length,$substring=)` | Truncates the string to a given length.  |
| `safeTruncate($length,$substring=)` | Truncates the string to a given length, while ensuring that it does not split words.  |
| `reverse` | Returns a reversed string. A multibyte version of strrev(). |
| `shuffle` | A multibyte str_shuffle() function. It returns a string with its characters in random order. |
| `trim` | Returns the trimmed string. An alias for PHP's trim() function. |
| `longestCommonPrefix($otherStr)` | Returns the longest common prefix between the string and $otherStr. |
| `longestCommonSuffix($otherStr)` | Returns the longest common suffix between the string and $otherStr. |
| `longestCommonSubstring($otherStr)` | Returns the longest common substring between the string and $otherStr. |
| `length` | Returns the length of the string. An alias for PHP's mb_strlen() function. |
| `substr($start,$length=null)` | Returns the substring beginning at $start with the specified $length. |
| `at($index)` | Returns the character at $index, with indexes starting at 0. |
| `first($n)` | Returns the first $n characters of the string. |
| `last($n)` | Returns the last $n characters of the string. |
| `ensureLeft($substring)` | Ensures that the string begins with $substring. If it doesn't, it's prepended. |
| `ensureRight($substring)` | Ensures that the string begins with $substring. If it doesn't, it's appended. |
| `removeLeft($substring)` | Returns a new string with the prefix $substring removed, if present. |
| `removeRight($substring)` | Returns a new string with the suffix $substring removed, if present. |
| `matchesPattern($pattern)` | Returns true if $str matches the supplied pattern, false otherwise. |
| `hasLowerCase` | Returns true if the string contains a lower case char, false otherwise. |
| `hasUpperCase` | Returns true if the string contains an upper case char, false otherwise. |
| `isAlpha` | Returns true if the string contains only alphabetic chars, false otherwise. |
| `isAlphanumeric` | Returns true if the string contains only alphabetic and numeric chars, false otherwise. |
| `isHexadecimal` | Returns true if the string contains only hexadecimal chars, false otherwise. |
| `isBlank` | Returns true if the string contains only whitespace chars, false otherwise. |
| `isJson` | Returns true if the string is JSON, false otherwise. |
| `isLowerCase` | Returns true if the string contains only lower case chars, false otherwise. |
| `isUpperCase` | Returns true if the string contains only lower case chars, false otherwise. |
| `isSerialized` | Returns true if the string is serialized, false otherwise. |
| `countSubstr($substring,$caseSensitive=true)` | Returns the number of occurrences of $substring in the given string. |
| `replace($search,$replacement)` | Replaces all occurrences of $search in $str by $replacement. |
| `regexReplace($pattern,$replacement,$options=msr)` | Replaces all occurrences of $pattern in $str by $replacement. |
| `accord($count,$many,$one,$zero=null)` | Create a string from a number. |
| `random($length=16)` | Generate a more truly "random" alpha-numeric string. |
| `quickRandom($length=16)` | Generate a "random" alpha-numeric string. |
| `randomStrings($words,$length=10)` | Generates a random suite of words. |
| `isIp($string)` | Check if a string is an IP. |
| `isEmail($string)` | Check if a string is an email. |
| `isUrl($string)` | Check if a string is an url. |
| `find($string,$needle,$caseSensitive=false,$absolute=false)` | Find one or more needles in one or more haystacks. |
| `slice($string,$slice)` | Slice a string with another string. |
| `sliceFrom($string,$slice)` | Slice a string from a certain point. |
| `sliceTo($string,$slice)` | Slice a string up to a certain point. |
| `baseClass($string)` | Get the base class in a namespace. |
| `prepend($string,$with)` | Prepend a string with another. |
| `append($string,$with)` | Append a string to another. |
| `limit($value,$limit=100,$end=...)` | Limit the number of characters in a string. |
| `remove($string,$remove)` | Remove part of a string. |
| `toggle($string,$first,$second,$loose=false)` | Toggles a string between two states. |
| `slug($title,$separator=-)` | Generate a URL friendly "slug" from a given string. |
| `explode($string,$with,$limit=null)` | Explode a string into an array. |
| `lower($string)` | Lowercase a string. |
| `plural($value)` | Get the plural form of an English word. |
| `singular($value)` | Get the singular form of an English word. |
| `upper($string)` | Lowercase a string. |
| `title($string)` | Convert a string to title case. |
| `words($value,$words=100,$end=...)` | Limit the number of words in a string. |
| `toPascalCase($string)` | Convert a string to PascalCase. |
| `toSnakeCase($string)` | Convert a string to snake_case. |
| `toCamelCase($string)` | Convert a string to camelCase. |
| `ascii($value)` | Transliterate a UTF-8 value to ASCII. |
| `camel($value)` | Convert a value to camel case. |
| `finish($value,$cap)` | Cap a string with a single instance of a given value. |
| `is($pattern,$value)` | Determine if a given string matches a given pattern. |
| `parseCallback($callback,$default)` | Parse a Class@method style callback into class and method. |
| `randomBytes($length=16)` | Generate a more truly "random" bytes. |
| `equals($knownString,$userInput)` | Compares two strings using a constant-time algorithm. |
| `snake($value,$delimiter=_)` | Convert a string to snake case. |
| `studly($value)` | Convert a value to studly caps case. |
| `ucfirst($string)` | Make a string's first character uppercase. |
