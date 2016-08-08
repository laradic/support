CustomApplicationPaths
-----------------------

A way to alter all of laravel's paths before any of them is used.

### Usage

To use custom paths you will have to overide the `bootstrappers` method in your `Kernel`. An example using the default `App\Http\Kernel` or `App\Console\Kernel`:

```php
namespace App\Http;

use Laradic\Support\Bootstrap\CustomApplicationPaths;

class Kernel extends HttpKernel {
    // ....
    protected function bootstrappers()
    {
        // The init function allows you to set a basePath and a configPath
        $this->getApplication()
             ->make(CustomApplicationPaths::class)
             ->init(null, null)
             ->bootstrap($this->app);
             
        return parent::bootstrappers();
    }
    // ....
}
```

### Configuration

Using the provided config file you can easily set the remaining paths:

```php
return [
	'app_path'      => 'app',
	'config_path'   => 'config',
	'database_path' => 'database',
	'lang_path'     => 'resources/lang',
	'public_path'   => 'public',
	'storage_path'  => 'storage'
];
```
