<?php


namespace Laradic\Support\Macros\Filesystem;


class EnsureDirectory
{
    public function __invoke()
    {
        return function ($path, $mode = 0755) {
            /** @var \Illuminate\Filesystem\Filesystem $self */
            $self = $this;
            if ( ! $self->exists($path)) {
                $self->makeDirectory($path, $mode, true);
            }
        };
    }

}