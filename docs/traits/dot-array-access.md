<!---
title: DotArrayAccess
subtitle: Traits
author: Robin Radic
-->

Provides a convieniant way to make a class property accessable as class array. It can be combined with `DotArrayObjectAccess` if required.

### Example
```php
class MyClass implements \ArrayAccess 
{
    use DotArrayAccess;
    
    # Abstract method that is mandatory to add. Should return the property name
    protected function getArrayAccessor() {
        return 'myProperty';
    }
    
    # The property tho allow array access on
    protected $myProperty = [
        'first' => 'second',
        'second' => 'third'
    ];
}

# Then the following can be done:
$myClass = new MyClass();
$second = $myClass['second']; # returns `third`
```
