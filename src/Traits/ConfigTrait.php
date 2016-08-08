<?php
/**
 * Part of the Laradic PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */


namespace Laradic\Support\Traits;

trait ConfigTrait
{
    protected $config = [ ];

    public function config($key = null, $default = null)
    {
        return $key === null ? $this->config : array_get($this->config, $key, $default);
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the config value
     *
     * @param mixed $config
     *
     * @return ConfigTrait
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }
}
