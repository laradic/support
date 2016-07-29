<!---
title: Arr
subtitle: Utilities
author: Robin Radic
-->


#### Overview
| Method | Description |
|:-------|:------------|
| `repeat($data,$times)` | Fill an array with $times times some $data. |
| `search($array,$value)` | Search for the index of a value in an array. |
| `matches($array,$closure)` | Check if all items in an array match a truth test. |
| `matchesAny($array,$closure)` | Check if any item in an array matches a truth test. |
| `contains($array,$value)` | Check if an item is in an array. |
| `average($array,$decimals=0)` | Returns the average value of an array. |
| `size($array)` | Get the size of an array. |
| `max($array,$closure=null)` | Get the max value from an array. |
| `min($array,$closure=null)` | Get the min value from an array. |
| `find($array,$closure)` | Find the first item in an array that passes the truth test. |
| `clean($array)` | Clean all falsy values from an array. |
| `random($array,$take=null)` | Get a random string from an array. |
| `without` | Return an array without all instances of certain values. |
| `intersection($a,$b)` | Return an array with all elements found in both input arrays. |
| `intersects($a,$b)` | Return a boolean flag which indicates whether the two input arrays have any common elements. |
| `first($array,$take=null)` | Get the first value from an array. |
| `last($array,$take=null)` | Get the last value from an array. |
| `initial($array,$to=1)` | Get everything but the last $to items. |
| `rest($array,$from=1)` | Get the last elements from index $from. |
| `at($array,$closure)` | Iterate over an array and execute a callback for each loop. |
| `replaceValue($array,$replace,$with)` | Replace a value in an array. |
| `replaceKeys($array,$keys)` | Replace the keys in an array with another set. |
| `each($array,$closure)` | Iterate over an array and modify the array's value. |
| `shuffle($array)` | Shuffle an array. |
| `sortKeys($array,$direction=ASC)` | Sort an array by key. |
| `implode($array,$with=)` | Implodes an array. |
| `filter($array,$closure=null)` | Find all items in an array that pass the truth test. |
| `flatten($array,$separator=.,$parent=null)` | Flattens an array to dot notation. |
| `invoke($array,$callable,$arguments=array())` | Invoke a function on all of an array's values. |
| `reject($array,$closure)` | Return all items that fail the truth test. |
| `removeFirst($array)` | Remove the first value from an array. |
| `removeLast($array)` | Remove the last value from an array. |
| `removeValue($array,$value)` | Removes a particular value from an array (numeric or associative). |
| `prepend($array,$value)` | Prepend a value to an array. |
| `append($array,$value)` | Append a value to an array. |
| `has($array,$key)` | Check if an array has a given key. |
| `get($collection,$key,$default=null)` | Get a value from an collection using dot-notation. |
| `set($collection,$key,$value)` | Set a value in a collection using dot notation. |
| `setAndGet(&$collection,$key,$default=null)` | Get a value from a collection and set it if it wasn't. |
| `remove($collection,$key)` | Remove a value from an array using dot notation. |
| `pluck($collection,$property)` | Fetches all columns $property from a multimensionnal array. |
| `filterBy($collection,$property,$value,$comparisonOp=null)` | Filters an array of objects (or a numeric array of associative arrays) based on the value of a particular property within that. |
| `findBy($collection,$property,$value,$comparisonOp=eq)` |  |
| `keys($collection)` | Get all keys from a collection. |
| `values($collection)` | Get all values from a collection. |
| `replace($collection,$replace,$key,$value)` | Replace a key with a new key/value pair. |
| `sort($collection,$sorter=null,$direction=asc)` | Sort a collection by value, by a closure or by a property. |
| `group($collection,$grouper)` | Group values from a collection according to the results of a closure. |
| `internalSet(&$collection,$key,$value)` | Internal mechanic of set method. |
| `internalRemove(&$collection,$key)` | Internal mechanics of remove method. |
| `add($array,$key,$value)` | Add an element to an array using "dot" notation if it doesn't exist. |
| `build($array,$callback)` | Build a new array using a callback. |
| `collapse($array)` | Collapse an array of arrays into a single array. |
| `divide($array)` | Divide an array into two arrays. One with keys and the other with values. |
| `dot($array,$prepend=)` | Flatten a multi-dimensional associative array with dots. |
| `except($array,$keys)` | Get all of the given array except for a specified array of items. |
| `fetch($array,$key)` | Fetch a flattened array of a nested array element. |
| `forget(&$array,$keys)` | Remove one or many array items from a given array using "dot" notation. |
| `isAssoc($array)` | Determines if an array is associative. |
| `only($array,$keys)` | Get a subset of the items from the given array. |
| `explodePluckParameters($value,$key)` | Explode the "value" and "key" arguments passed to "pluck". |
| `pull(&$array,$key,$default=null)` | Get a value from the array, and remove it. |
| `sortRecursive($array)` | Recursively sort an array by keys and values. |
| `where($array,$callback)` | Filter the array using the given callback. |
| `unflatten($array,$delimiter=.)` | Unflattens a single stacked array back into a multidimensional array. |
