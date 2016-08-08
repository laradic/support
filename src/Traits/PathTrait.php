<?php
/**
 * Part of the Laradic PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */


namespace Laradic\Support\Traits;

use Laradic\Support\Path;

trait PathTrait
{
    protected $path;

    /**
     * path method
     *
     * @param null|string $path
     * @param bool $canonicalize
     *
     * @return string
     */
    public function path($path = null, $canonicalize = false)
    {
        $path = $path === null ? $this->path : Path::join($this->path, $path);
        return $canonicalize ? Path::canonicalize($path) : $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the path value
     *
     * @param mixed $path
     *
     * @return PathTrait
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
}
