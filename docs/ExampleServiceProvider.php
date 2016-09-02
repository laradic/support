<?php

class ExampleServiceProvider extends \Laradic\ServiceProvider\ServiceProvider
{
    protected $dir = __DIR__;

    protected $configFiles = ['example', 'themes']; // config/example.php && config/themes.php


    /*
     |---------------------------------------------------------------------
     | Resources properties
     |---------------------------------------------------------------------
     |
     */

    /**
     * Path to resources directory, relative to $dir
     *
     * @var string
     */
    protected $resourcesPath = '../resources';

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
    protected $viewsDestinationPath = 'resources/views/vendor/{namespace}';

    /**
     * Package views path
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
     * Assets destination path, relative to public_path
     *
     * @var string
     */
    protected $assetsDestinationPath = 'vendor/{namespace}';

    /**
     * Package views path
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
     * Path to the config directory, relative to $dir
     *
     * @var string
     */
    protected $configPath = '../config';

    protected $configStrategy = 'defaultConfigStrategy';

    /*
     |---------------------------------------------------------------------
     | Database properties
     |---------------------------------------------------------------------
     |
     */

    /**
     * Path to the migration destination directory, relative to database_path
     *
     * @var string
     */
    protected $migrationDestinationPath = 'migrations';

    /**
     * Path to the seeds destination directory, relative to database_path
     *
     * @var string
     */
    protected $seedsDestinationPath = 'seeds';

    /**
     * Path to database directory, relative to $dir
     *
     * @var string
     */
    protected $databasePath = '../database';

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
     * Collection of service providers.
     *
     * @var array
     */
    protected $providers = [ ];

    /**
     * Collection of service providers that are deffered
     *
     * @var array
     */
    protected $deferredProviders = [ ];

    /**
     * Collection of classes to bind in the IOC container
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
     */
    protected $commands = [ ];

    protected $commandPrefix = 'command.';

    /**
     * Collection of paths to search for commands
     * @var array
     */
    protected $findCommands = [ ];

    protected $findCommandsRecursive = false;

    protected $findCommandsExtending = 'Symfony\Component\Console\Command\Command';

    /**
     * @var array
     */
    protected $facades = [ /* 'Form' => Path\To\Facade::class */ ];

    /**
     * Collection of helper php files. To be included either on register or boot. Filepath is relative to $dir
     *
     * @var array
     */
    protected $helpers = [ /* $filePath => 'boot/register'  */ ];



}