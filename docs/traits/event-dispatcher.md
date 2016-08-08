<!---
title: EventDispatcher
subtitle: Traits
author: Robin Radic
-->

The `EventDispatcher` trait is an easy way to make your class able to fire events and have listeners register for them.
You can use the `fireEvent($name, $payload = null)` and `registerEvent($name, Closure $callback)` methods after adding the trait;

### Example
```php
use Laradic\Support\Traits\EventDispatcher;

class MyClass {
    use EventDispatcher;
    
    # This is my awesome function that fires off events
    public function __construct(){
        $this->registerEvent('my-awesome-event', function(MyClass $class){
        
        })
    }
    
    # This is my awesome function that fires off events
    public function myAwesomeFunction(){
        $this->fireEvent('my-awesome-event', [ $this ])
    }
}

$myClass = new MyClass();
$myClass->myAwesomeFunction();
```
