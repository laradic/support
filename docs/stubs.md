<!---
title: StubGenerator
subtitle: Utilities
author: Robin Radic
-->

The stub generator utilizes the BladeCompiler to generate files from a template.
 
The `StubGenerator` is bound to `beverage.generator`. It only has 1 method: `render($string, array $vars = [])`.

It registers the `.stub` extension. `.stub` files are simply `blade` templates.

#### Example template
 
```php
{!! $open !!}
/**
 * Part of  {{ $config['author.name'] }}'s PHP packages.
 *
 * {{ $config['license'] }} and copyright information bundled with this package
 * in the LICENSE file or visit {{ $config['license_link'] }}
 */
namespace {{ $namespace }};

use Illuminate\Support\ServiceProvider;

/**
 * {@inheritdoc}
 */
class {{ ucfirst($package) }}ServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
    }
}
```

#### Example usage
```php
$rendered = app('beverage.generator')->render( file_get('path/to/file.stub'), [ 
    'config' => [ 'author.name' => 'me' ],
    'package' => 'packagename'
]);
```
