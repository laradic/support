<!---
title: ConsoleProvider
subtitle: Abstraction
author: Robin Radic
-->

The console provider is an abstract class that allows easy command registration.
The `ConsoleProvider` handles the IoC bindings for you, as well as registering them as commands and adding them to the `provides()`.
It's advisable to add your `ConsoleProvider` to your package `ServiceProvider` its '$providers` property.

### Example
```php
namespace MyPackage\Providers;

use Laradic\Support\ConsoleServiceProvider;

class MyConsoleProvider extends ConsoleServiceProvider {

    # The namespace where the commands you want to register reside in
    protected $namespace = 'MyPackage\\Console';

    # The commands will be binded into the IoC container with this prefix
    protected $prefix = 'mypackage.commands.';

    # The commands you want to register.
    # The keys are the binding names, which get prefixed with $prefix
    # The values are partial class names that reside in the $namespace
    # The values will get suffixed with Command, so the first item will be:
    # mypackage.commands.list => MyPackage\Console\WorkbenchListCommand
    protected $commands = [
        'list'   => 'WorkbenchList',
        'make'   => 'WorkbenchMake',
        'commit' => 'WorkbenchCommit',
        'bump'   => 'WorkbenchBump',
    ];
}
```

Then in your main `ServiceProvider` you should add it to the `$providers` array as shown below:


```php
namespace MyPackage;

use Laradic\ServiceProvider\ServiceProvider;

class MyServiceProvider extends ServiceProvider {
    protected $providers = [
        \MyPackage\Providers\MyConsoleProvider::class
    ];
}
```
