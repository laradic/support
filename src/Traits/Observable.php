<?php
/**
 * Part of the Laradic PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */


namespace Laradic\Support\Traits;

trait Observable
{
    use StaticEventTrait;

    protected $observables = [ ];

    protected static function getEventNamespace()
    {
        return property_exists(static::class, 'eventNamespace') ? static::$eventNamespace : get_called_class();
    }

    /**
     * Remove all of the event listeners for the model.
     *
     * @return void
     */
    public static function flushEventListeners()
    {
        if (!isset(static::$dispatcher)) {
            return;
        }

        $instance  = new static;
        $namespace = static::getEventNamespace();

        foreach ($instance->getObservableEvents() as $event) {
            static::$dispatcher->forget("{$namespace}.{$event}: " . get_called_class());
        }
    }

    /**
     * Register a model event with the dispatcher.
     *
     * @param  string          $event
     * @param  \Closure|string $callback
     * @param  int             $priority
     *
     * @return void
     */
    protected static function registerEvent($event, $callback, $priority = 0)
    {
        if (!isset(static::$dispatcher)) {
            static::initEventDispatcher();
        }
        $name      = get_called_class();
        $namespace = static::getEventNamespace();

        static::$dispatcher->listen("{$namespace}.{$event}: {$name}", $callback, $priority);
    }

    /**
     * Get the observable event names.
     *
     * @return array
     */
    public function getObservableEvents()
    {
        return $this->observables;
    }

    /**
     * Set the observable event names.
     *
     * @param  array $observables
     *
     * @return $this
     */
    public function setObservableEvents(array $observables)
    {
        $this->observables = $observables;

        return $this;
    }

    /**
     * Add an observable event name.
     *
     * @param  array|mixed $observables
     *
     * @return void
     */
    public function addObservableEvents($observables)
    {
        $observables = is_array($observables) ? $observables : func_get_args();
        $this->observables = array_unique(array_merge($this->observables, $observables));
    }

    /**
     * Remove an observable event name.
     *
     * @param  array|mixed $observables
     *
     * @return void
     */
    public function removeObservableEvents($observables)
    {
        $observables = is_array($observables) ? $observables : func_get_args();

        $this->observables = array_diff($this->observables, $observables);
    }
}
