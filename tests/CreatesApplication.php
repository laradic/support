<?php
/**
 * Part of the Laradic PHP Packages.
 *
 * Copyright (c) 2017. Robin Radic.
 *
 * The license can be found in the package and online at https://laradic.mit-license.org.
 *
 * @copyright Copyright 2017 (c) Robin Radic
 * @license https://laradic.mit-license.org The MIT License
 */

namespace Laradic\Tests\Support;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $path = __DIR__ . '/../bootstrap/app.php';
        if ( ! file_exists($path)) {
            $path = __DIR__ . '/../../../../bootstrap/app.php';
        }

        $app = require $path;

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
