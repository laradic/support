<!---
title: DotArrayObjectAccess
subtitle: Traits
author: Robin Radic
-->

Makes items in an array of a property accessible as object, should be used in combination with `DotArrayAccess`.  

### Example
```php
class MyClass implements \ArrayAccess 
{
    use DotArrayAccess, DotArrayObjectAccess;
    
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
$second = $myClass->second; # returns `third`
```
