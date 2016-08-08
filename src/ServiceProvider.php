<?php
/**
 * Part of the Laradic PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Support;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use ReflectionClass;
use Laradic\Filesystem\Filesystem;


/**
 * Extends Laravel's base service provider with added functionality
 *
 * @author    Laradic Dev Team
 * @copyright Copyright (c) 2015, Laradic
 * @license   https://tldrlegal.com/license/mit-license MIT License
 * @package   Laradic\Support
 * @property \Illuminate\Foundation\Application $app
 * @example
 * <?php
 * $new = new ServiceProvider;
 */
abstract class ServiceProvider extends BaseServiceProvider
{
    const ON_REGISTER = 1;
    const ON_REGISTERED = 2;
    const ON_BOOT = 3;
    const ON_BOOTED = 4;

    const METHOD_REGISTER = 1;
    const METHOD_RESOLVE = 2;

    /**
     * Enables strict checking of provided bindings, aliases and singletons. Checks if the given items are correct. Set to false if
     *
     * @var bool
     */
    protected $strict = true;

    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * The src directory path
     * @deprecated use $scanDirs = true
     * @var string
     */
    protected $dir;

    protected $rootDir;

    protected $scanDirs = true;

    protected $scanDirsMaxLevel = 4;

    protected $resolvedPaths;

    /*
     |---------------------------------------------------------------------
     | Resources properties
     |---------------------------------------------------------------------
     |
     */

    /**
     * Path to resources directory, relative to package root
     *
     * @var string
     */
    protected $resourcesPath = 'resources'; //'../resources';

    /**
     * Resource destination path, relative to base_path
     *
     * @var string
     */
    protected $resourcesDestinationPath = 'resources';


    /*
     |---------------------------------------------------------------------
     | Views properties
     |---------------------------------------------------------------------
     |
     */

    /**
     * View destination path, relative to base_path
     *
     * @var string
     */
    protected $viewsDestinationPath = '{resourcesDestinationPath}/views/vendor/{namespace}';

    /**
     * Package views path, relative to package root
     *
     * @var string
     */
    protected $viewsPath = '{resourcesPath}/{dirName}';

    /**
     * A collection of directories in this package containing views.
     * ['dirName' => 'namespace']
     *
     * @var array
     */
    protected $viewDirs = [ /* 'dirName' => 'namespace' */ ];


    /*
     |---------------------------------------------------------------------
     | Assets properties
     |---------------------------------------------------------------------
     |
     */

    /**
     * Assets destination path, relative to base_path
     *
     * @var string
     */
    protected $assetsDestinationPath = 'public/vendor/{namespace}';

    /**
     * Package assets path, relative to package root folder
     *
     * @var string
     */
    protected $assetsPath = '{resourcesPath}/{dirName}';

    /**
     * A collection of directories in this package containing assets.
     * ['dirName' => 'namespace']
     *
     * @var array
     */
    protected $assetDirs = [ /* 'dirName' => 'namespace' */ ];


    /*
     |---------------------------------------------------------------------
     | Configuration properties
     |---------------------------------------------------------------------
     |
     */

    /**
     * Collection of configuration files.
     *
     * @var array
     */
    protected $configFiles = [ ];

    /**
     * Path to the config directory, relative to package root folder
     *
     * @var string
     */
    protected $configPath = 'config';

    protected $configStrategy = 'defaultConfigStrategy';

    /*
     |---------------------------------------------------------------------
     | Database properties
     |---------------------------------------------------------------------
     |
     */

    /**
     * Path to the migration destination directory, relative to package root folder
     *
     * @var string
     */
    protected $migrationDestinationPath = '{databasePath}/migrations';

    /**
     * Path to the seeds destination directory, relative to package root folder
     *
     * @var string
     */
    protected $seedsDestinationPath = '{databasePath}/seeds';

    /**
     * Path to database directory, relative to  package root folder
     *
     * @var string
     */
    protected $databasePath = 'database';

    /**
     * Array of directory names/paths relative to $databasePath containing seed files.
     *
     * @var array
     */
    protected $seedDirs = [ /* 'dirName', */ ];

    /**
     * Array of directory names/paths relative to $databasePath containing migration files.
     *
     * @var array
     */
    protected $migrationDirs = [ /* 'dirName', */ ];


    /*
     |---------------------------------------------------------------------
     | Miscellaneous properties
     |---------------------------------------------------------------------
     |
     */

    /**
     * These Service Providers will be registered. Basicaly providing a shortcut to app()->register(). Use FQN.
     *
     * @var array
     */
    protected $providers = [ ];

    /**
     * These Service Providers will be registered as deferred. Basicaly providing a shortcut to app()->registerDeferredProvider(). Use FQN.
     *
     * @var array
     */
    protected $deferredProviders = [ ];

    /**
     * Define the point where the $providers and $deferredProviders should be registered. accepts one of ON_REGISTER | ON_REGISTERED | ON_BOOT | ON_BOOTED
     *
     * @var int
     */
    protected $registerProvidersOn = self::ON_REGISTER;

    protected $registerProvidersMethod = self::METHOD_REGISTER;

    /**
     * Names with associated class that will be bound into the container
     *
     * @var array
     */
    protected $bindings = [ ];

    /**
     * Collection of classes to register as singleton
     *
     * @var array
     */
    protected $singletons = [ ];

    /**
     * Collection of classes to register as share. Does not make an alias if the value is a class, as is the case with $shared.
     *
     * @var array
     */
    protected $share = [ ];

    /**
     * Collection of classes to register as share. Also registers an alias if the value is a class, as opposite to $share.
     *
     * @var array
     */
    protected $shared = [ ];

    /**
     * Wealkings are bindings that perform a bound check and will not override other bindings
     *
     * @var array
     */
    protected $weaklings = [ ];

    /**
     * Collection of aliases.
     *
     * @var array
     */
    protected $aliases = [ ];

    /**
     * Collection of middleware.
     *
     * @var array
     */
    protected $middleware = [ ];

    /**
     * Collection of prepend middleware.
     *
     * @var array
     */
    protected $prependMiddleware = [ ];

    /**
     * Collection of route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [ ];

    /**
     * Collection of bound instances.
     *
     * @var array
     */
    protected $provides = [ ];

    /**
     * Collection of commands.
     *
     * @var array
     * @example
     * <?php
     * $new = new ServiceProvider;
     */
    protected $commands = [ ];

    /**
     * Commands that are found are bound in the container using this string as prefix
     * @var string
     */
    protected $commandPrefix = 'command.';

    /**
     * Collection of paths to search for commands
     * @var array
     */
    protected $findCommands = [ ];

    /**
     * If true, the $findCommands path will be searched recursively (all subdirectories will be scanned) for commands
     * @var bool
     */
    protected $findCommandsRecursive = false;

    /**
     *  Commands should extend
     * @var string
     */
    protected $findCommandsExtending = 'Symfony\Component\Console\Command\Command';

    /**
     * @var array
     */
    protected $facades = [ /* 'Form' => Path\To\Facade::class */ ];

    /**
     * Collection of helper php files. To be required either on register or boot. [$filePath => self::ON_REGISTERED].
     * Accepts values: ON_REGISTER | ON_REGISTERED | ON_BOOT | ON_BOOTED
     *
     * @var array
     */
    protected $helpers = [ /* $filePath => 'boot/register'  */ ];

    /**
     * Declaring the method named here will make it so it will be called on application booting
     *
     * @var string
     */
    protected $bootingMethod = 'booting';

    /**
     * Declaring the method named here will make it so it will be called when the application has booted
     *
     * @var string
     */
    protected $bootedMethod = 'booted';

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [];

    /*
     |---------------------------------------------------------------------
     | Booting functions
     |---------------------------------------------------------------------
     |
     */

    /**
     * Perform the booting of the service.
     *
     * @return \Illuminate\Foundation\Application
     * @example
     * <?php
     * $new = new ServiceProvider;
     */
    public function boot()
    {

        $this->tryRequireHelpers(self::ON_BOOT);
        $this->tryRegisterProviders(self::ON_BOOT);

        // Events
        $events = $this->app->make('events');

        foreach ($this->listens() as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }

        foreach ($this->subscribe as $subscriber) {
            $events->subscribe($subscriber);
        }

        // Publish
        if ( null !== $this->rootDir ) {
            $this->bootConfigFiles();
            foreach ( $this->viewDirs as $dirName => $namespace ) {
                $viewPath = $this->resolvePath('viewsPath', compact('dirName'));
                $this->loadViewsFrom($viewPath, $namespace);
                $this->publishes([ $viewPath => $this->resolvePath('viewsDestinationPath', compact('namespace')) ], 'views');
            }
            foreach ( $this->assetDirs as $dirName => $namespace ) {
                $this->publishes([ $this->resolvePath('assetsPath', compact('dirName')) => $this->resolvePath('assetsDestinationPath', compact('namespace')) ], 'public');
            }
            foreach ( $this->migrationDirs as $dirPath ) {
                $this->publishes([ $this->getDatabasePath($dirPath) => $this->resolvePath('migrationDestinationPath') ], 'database');
            }
            foreach ( $this->seedDirs as $dirPath ) {
                $this->publishes([ $this->getDatabasePath($dirPath) => $this->resolvePath('seedsDestinationPath') ], 'database');
            }
        }

        $this->tryRequireHelpers(self::ON_BOOTED);
        $this->tryRegisterProviders(self::ON_BOOTED);

        return $this->app;
    }

    /**
     * Adds the config files defined in $configFiles to the publish procedure.
     * Can be overriden to adjust default functionality
     */
    protected function bootConfigFiles($configFiles = null, $path = null)
    {
        if ( $configFiles === null ) {
            $configFiles = $this->configFiles;
        }
        if ( ! is_array($configFiles) ) {
            $configFiles = [ $configFiles ];
        }
        if ( isset($this->rootDir, $configFiles) ) {
            foreach ( $configFiles as $fileName ) {
                $filePath = $path === null ? $this->resolvePath('configPath') : path_join($path, $fileName);
                $this->publishes([ $filePath => config_path($fileName . '.php') ], 'config');
            }
        }
    }


    /*
     |---------------------------------------------------------------------
     | Registration functions
     |---------------------------------------------------------------------
     |
     */

    /**
     * Registers the server in the container.
     *
     * @return \Illuminate\Foundation\Application
     * @throws \Exception
     */
    public function register()
    {
        $this->resolveDirectories();

        $this->tryRequireHelpers(self::ON_REGISTER);
        $this->tryRegisterProviders(self::ON_REGISTER);

        if ( method_exists($this, $this->bootingMethod) ) {
            $this->app->booting(function (Application $app) {
                $app->call([ $this, $this->bootingMethod ]);
            });
        }

        if ( method_exists($this, $this->bootedMethod) ) {
            $this->app->booted(function (Application $app) {
                $app->call([ $this, $this->bootedMethod ]);
            });
        }

        // Config
        $this->registerConfigFiles();

        // Middlewares
        if ( ! $this->app->runningInConsole() ) {
            $router = $this->app->make('router');
            $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');

            foreach ( $this->prependMiddleware as $middleware ) {
                $kernel->prependMiddleware($middleware);
            }

            foreach ( $this->middleware as $middleware ) {
                $kernel->pushMiddleware($middleware);
            }

            foreach ( $this->routeMiddleware as $key => $middleware ) {
                $router->middleware($key, $middleware);
            }
        }

        // Container bindings and aliases
        foreach ( $this->bindings as $binding => $class ) {
            $this->app->bind($binding, $class);
        }

        foreach ( $this->weaklings as $binding => $class ) {
            $this->bindIf($binding, $class);
        }

        foreach ( [ 'share' => $this->share, 'shared' => $this->shared ] as $type => $bindings ) {
            foreach ( $bindings as $binding => $class ) {
                $this->share($binding, $class, [ ], $type === 'shared');
            }
        }

        foreach ( $this->singletons as $binding => $class ) {
            if ( $this->strict && ! class_exists($class) && ! interface_exists($class) ) {
                throw new \Exception(get_called_class() . ": Could not find alias class [{$class}]. This exception is only thrown when \$strict checking is enabled");
            }
            $this->app->singleton($binding, $class);
        }

        foreach ( $this->aliases as $alias => $full ) {
            if ( $this->strict && ! class_exists($full) && ! interface_exists($full) ) {
                throw new \Exception(get_called_class() . ": Could not find alias class [{$full}]. This exception is only thrown when \$strict checking is enabled");
            }
            $this->app->alias($alias, $full);
        }


        // Commands
        if ( $this->app->runningInConsole() ) {
            foreach ( $this->findCommands as $path ) {
                $dir     = path_get_directory((new ReflectionClass(get_called_class()))->getFileName());
                $classes = $this->findCommandsIn(path_join($dir, $path), $this->findCommandsRecursive);

                $this->commands = array_merge($this->commands, $classes);
            }
            if ( is_array($this->commands) && count($this->commands) > 0 ) {
                $commands = [ ];
                foreach ( $this->commands as $k => $v ) {
                    if ( is_string($k) ) {
                        $this->app[ $this->commandPrefix . $k ] = $this->app->share(function ($app) use ($k, $v) {
                            return $app->build($v);
                        });

                        $commands[] = $this->commandPrefix . $k;
                    } else {
                        $commands[] = $v;
                    }
                }
                $this->commands($commands);
            }
        }
        // Facades
        if ( class_exists('Illuminate\Foundation\AliasLoader') ) {
            \Illuminate\Foundation\AliasLoader::getInstance($this->facades)->register();
        }

        // Helpers
        $this->tryRequireHelpers(self::ON_REGISTERED);

        $this->tryRegisterProviders(self::ON_REGISTERED);

        return $this->app;
    }

    /**
     * The default config merge function, instead of using the laravel mergeConfigRom it
     *
     * @param $path
     * @param $key
     */
    protected function defaultConfigStrategy($path, $key)
    {
        $config = $this->app->make('config')->get($key, [ ]);
        $this->app->make('config')->set($key, array_replace_recursive(require $path, $config));
    }

    /**
     * Merges all defined config files defined in $configFiles.
     * Can be overriden to adjust default functionality
     */
    protected function registerConfigFiles($configFiles = null, $path = null)
    {
        if ( $configFiles === null ) {
            $configFiles = $this->configFiles;
        }
        if ( ! is_array($configFiles) ) {
            $configFiles = [ $configFiles ];
        }
        if ( isset($this->rootDir, $configFiles) ) {
            $path = $path ?: $this->resolvePath('configPath');
            foreach ( $configFiles as $key ) {
                call_user_func_array([ $this, $this->configStrategy ], [ path_join($path, $key . '.php'), $key ]);
            }
        }
    }

    /**
     * This will check method
     *
     * @param $on
     */
    protected function tryRequireHelpers($on)
    {
        foreach ( $this->helpers as $filePath => $for ) {
            if ( $on === $for ) {
                require_once path_join($this->rootDir, $filePath);
            }
        }
    }

    /**
     * tryRegisterProviders method
     *
     * @param $on
     */
    protected function tryRegisterProviders($on)
    {
        if ( $on === $this->registerProvidersOn && $this->registerProvidersMethod === self::METHOD_REGISTER ) {
            // FIRST register all given providers
            foreach ( $this->providers as $provider ) {
                $this->app->register($provider);
            }

            foreach ( $this->deferredProviders as $provider ) {
                $this->app->registerDeferredProvider($provider);
            }
        } elseif ( $this->registerProvidersMethod === self::METHOD_RESOLVE ) {
            foreach ( $this->providers as $provider ) {
                $resolved = $this->app->resolveProviderClass($registered[] = $provider);
                if ( $on === self::ON_REGISTER ) {
                    $resolved->register();
                } elseif ( $on === self::ON_BOOT ) {
                    $this->app->call([ $provider, 'boot' ]);
                }
            }
        }
    }

    /**
     * on method
     *
     * @param $events
     * @param $handler
     */
    protected function on($events, $handler)
    {
        $dispatcher = $this->app->make('events');
        $dispatcher->listen($events, $handler);
    }

    /**
     * overrideConfig method
     *
     * @param        $fileName
     * @param string $method
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function overrideConfig($fileName, $method = 'array_replace_recursive')
    {
        /** @var Repository $config */
        $config    = $this->app->make('config');
        $fileName  = Str::ensureRight($fileName, '.php');
        $filePath  = path_join($this->resolvePath('configPath'), $fileName);
        $overrides = Filesystem::create()->getRequire($filePath);

        foreach ( $overrides as $k => $v ) {
            if ( $config->has($k) && is_array($config->get($k)) ) {
                $v = call_user_func($method, $config->get($k, [ ]), $v);
            }
            $config->set($k, $v);
        }
    }

    /**
     * Push a Middleware on to the stack
     *
     * @param $middleware
     *
     * @return mixed
     */
    protected function pushMiddleware($middleware, $force = false)
    {
        if ( $this->app->runningInConsole() && $force === false ) {
            return $this->getHttpKernel();
        }
        return $this->getHttpKernel()->pushMiddleware($middleware);
    }

    /**
     * getHttpKernel method
     * @return \App\Http\Kernel|\Illuminate\Contracts\Http\Kernel
     */
    protected function getHttpKernel()
    {
        return $this->app->make('Illuminate\Contracts\Http\Kernel');
    }

    /**
     * getRouter method
     * @return \Illuminate\Contracts\Routing\Registrar|\Illuminate\Routing\Router
     */
    protected function getRouter()
    {
        return $this->app->make('router');
    }

    /**
     * Prepend a Middleware in the stack
     *
     * @param $middleware
     *
     * @return \Illuminate\Contracts\Routing\Registrar|\Illuminate\Routing\Router
     */
    protected function prependMiddleware($middleware, $force = false)
    {
        if ( $this->app->runningInConsole() && $force === false ) {
            $this->getHttpKernel();
        }

        return $this->getHttpKernel()->prependMiddleware($middleware);
    }

    /**
     * Add a route middleware. Will not be added when running in console.
     *
     * @param      $key
     * @param null $middleware
     *
     * @param bool $force
     *
     * @return \Illuminate\Contracts\Routing\Registrar|\Illuminate\Routing\Router
     */
    protected function routeMiddleware($key, $middleware = null, $force = false)
    {

        if ( $this->app->runningInConsole() && $force === false ) {
            return $this->getRouter();
        }
        if ( is_array($key) ) {
            foreach ( $key as $k => $m ) {
                $this->routeMiddleware($k, $m);
            }
            return $this->getRouter();
        } else {
            $this->getRouter()->middleware($key, $middleware);
        }
    }

    /**
     * Registers a binding if it hasn't already been registered.
     *
     * @param  string               $abstract
     * @param  \Closure|string|null $concrete
     * @param  bool                 $shared
     * @param  bool|string|null     $alias
     *
     * @return void
     */
    protected function bindIf($abstract, $concrete = null, $shared = true, $alias = null)
    {
        if ( ! $this->app->bound($abstract) ) {
            $concrete = $concrete ?: $abstract;

            $this->app->bind($abstract, $concrete, $shared);
        }
    }

    /**
     * Register a class so it's shared. Optionally create an alias for it.
     *
     * @param       $binding
     * @param       $class
     * @param array $params
     * @param bool  $alias
     */
    protected function share($binding, $class, $params = [ ], $alias = false)
    {
        if ( is_string($class) ) {
            $closure = function ($app) use ($class, $params) {
                return $app->build($class, $params);
            };
        } else {
            $closure = $class;
        }
        $this->app[ $binding ] = $this->app->share($closure);
        if ( $alias ) {
            $this->app->alias($binding, $class);
        }
    }


    /**
     * resolveDirectories method
     */
    protected function resolveDirectories()
    {
        if ( $this->scanDirs !== true ) {
            return;
        }
        if ( $this->rootDir === null ) {
            $class    = new ReflectionClass(get_called_class());
            $filePath = $class->getFileName();
            $rootDir  = path_get_directory($filePath);
            $found    = false;
            for ( $i = 0; $i < $this->scanDirsMaxLevel; $i++ ) {
                if ( file_exists($composerPath = path_join($rootDir, 'composer.json')) ) {
                    $found = true;
                    break;
                } else {
                    $rootDir = path_get_directory($rootDir); // go 1 up
                }
            }
            if ( $found === false ) {
                throw new \OutOfBoundsException("Could not determinse composer.json file location in [{$this->dir}] or in {$this->scanDirsMaxLevel} parents of [$this->rootDir}]");
            }
            $this->rootDir = $rootDir;
        }

        $this->dir = $this->dir ?: path_join($this->rootDir, 'src');
    }

    /**
     * resolvePath method
     *
     * @todo
     *
     * @param       $pathPropertyName
     * @param array $extras
     *
     * @return string
     */
    protected function resolvePath($pathPropertyName, array $extras = [ ])
    {
        $resolvedPaths = $this->getResolvedPaths();
        $basePath      = base_path();
        $publicPath    = public_path();
        $extras        = array_merge(compact('basePath', 'publicPath'), $extras);
        return Util::template($resolvedPaths[ $pathPropertyName ], $extras);
    }

    /**
     * resolvePaths method
     * @todo
     * @return array
     */
    protected function getResolvedPaths()
    {
        if ( null === $this->resolvedPaths ) {
            $this->resolveDirectories();
            // Collect all path properties and put them into $paths associatively using propertyName => propertyValue
            $paths = [ ];
            collect(array_keys(get_class_vars(get_class($this))))->filter(function ($propertyName) {
                return ends_with($propertyName, 'Path');
            })->each(function ($propertyName) use (&$paths) {
                $paths[ $propertyName ] = $this->{$propertyName}; //
            });

            // Use the paths to generate parsed paths, resolving all the {vars}
            $this->resolvedPaths = collect($paths)->transform(function ($path) use ($paths) {
                return Util::template($path, $paths);
            })->transform(function ($path, $propertyName) {
                return ends_with($propertyName, 'DestinationPath') ? base_path($path) : path_join($this->rootDir, $path);
            })->toArray();
        }
        return $this->resolvedPaths;
    }

    /**
     * getMigrationFilePath
     *
     * @param null $path
     *
     * @return string
     */
    protected function getDatabasePath($path = null)
    {
        return $path ? path_join($this->resolvePath('databasePath'), $path) : $this->resolvePath('databasePath');
    }

    /**
     * findCommandsIn method
     *
     * @param      $path
     * @param bool $recursive
     *
     * @return array
     */
    protected function findCommandsIn($path, $recursive = false)
    {
        $classes = [ ];
        foreach ( $this->findCommandsFiles($path) as $filePath ) {
            $class = Util::getClassNameFromFile($filePath);
            if ( $class !== null ) {
                $namespace = Util::getNamespaceFromFile($filePath);
                if ( $namespace !== null ) {
                    $class = "$namespace\\$class";
                }
                $class   = Str::removeLeft($class, '\\');
                $parents = class_parents($class);
                if ( $this->findCommandsExtending !== null && in_array($this->findCommandsExtending, $parents, true) === false ) {
                    continue;
                }
                $classes[] = Str::removeLeft($class, '\\');
            }
        }
        return $classes;
    }

    /**
     * findCommandsFiles method
     *
     * @param $directory
     *
     * @return array
     */
    protected function findCommandsFiles($directory)
    {
        $glob = glob($directory . '/*');

        if ( $glob === false ) {
            return [ ];
        }

        // To get the appropriate files, we'll simply glob the directory and filter
        // out any "files" that are not truly files so we do not end up with any
        // directories in our list, but only true files within the directory.
        return array_filter($glob, function ($file) {
            return filetype($file) == 'file';
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        $provides = $this->provides;

        foreach ( $this->providers as $provider ) {
            $instance = $this->app->resolveProviderClass($provider);

            $provides = array_merge($provides, $instance->provides());
        }

        $commands = [ ];
        foreach ( $this->commands as $k => $v ) {
            if ( is_string($k) ) {
                $commands[] = $k;
            }
        }

        return array_merge(
            $provides,
            array_keys($this->aliases),
            array_keys($this->bindings),
            array_keys($this->share),
            array_keys($this->shared),
            array_keys($this->singletons),
            array_keys($this->weaklings),
            $commands
        );
    }

    /**
     * Get the events and handlers.
     *
     * @return array
     */
    public function listens()
    {
        return $this->listen;
    }
}
