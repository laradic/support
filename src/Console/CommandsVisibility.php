<?php

namespace Laradic\Support\Console;

use Illuminate\Support\Str;

class CommandsVisibility
{
    /** @var \Symfony\Component\Console\Command\Command[] */
    protected $hiddenCommands;

    /** @var array|\Laradic\Support\Dot */
    protected $visibility = [
        'hide' => [],
        'show' => [],
    ];

    protected function argument($argument)
    {
        if (is_array($argument) && count($argument) === 1 && is_array($argument[ 0 ])) {
            $argument = $argument[ 0 ];
        }
        return $argument;
    }

    protected function merge($option, $commands)
    {
        $this->visibility[ $option ] = array_unique(array_merge($this->visibility[ $option ], $this->argument($commands)));
        return $this;
    }

    public function hide(...$patterns)
    {
        return $this->merge('hide', $patterns);
    }

    public function show(...$patterns)
    {
        return $this->merge('show', $patterns);
    }

    public function shouldHideCommand($name)
    {
        $hide = Str::is($this->visibility[ 'hide' ], $name);
        $show = Str::is($this->visibility[ 'show' ], $name);
        if ($visibility = env('PYRO_COMMAND_VISIBILITY', null)) {
            Str::is($visibility, $name);
        }
        if ($hide) {
            return ! $show;
        }
        return false;

//        if ( ! $hide && $show) {
//            return false;
//        }
//        return $hide && ! $show;
    }

    public function hideDefaultLaravelNamespaces()
    {
        $this->hide(
            'app:*',
            'auth:*',
            'cache:*',
            'config:*',
            'db:*',
            'event:*',
            'key:*',
            'make:*',
            'migrate:*',
            'notifications:*',
            'optimize:*',
            'package:*',
            'queue:*',
            'route:*',
            'schedule:*',
            'session:*',
            'storage:*',
            'vendor:*',
            'view:*'
        );
        return $this;
    }

}
