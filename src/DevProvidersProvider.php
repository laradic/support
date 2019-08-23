<?php

namespace Laradic\Support;

use Illuminate\Support\ServiceProvider;

class DevProvidersProvider extends ServiceProvider
{
    public function __construct($app)
    {
        parent::__construct($app);
        $config = $app[ 'config' ][ 'laradic.support.dev_providers' ];
        if ( ! $app[ 'config' ][ 'app.debug' ] || ! $config[ 'enabled' ]) {
            return;
        }
        $when = $app[ 'config' ][ $config[ 'when' ] ];
        if ($when !== $config[ 'is' ]) {
            return;
        }
        array_map([ $app, 'register' ], $app[ 'config' ]->get($config[ 'key' ], []));
    }

}
