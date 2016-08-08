<?php
/**
 * Part of the Laradic PHP packages.
 *
 * MIT License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Support\Traits;

use Illuminate\Contracts\Events\Dispatcher;

/**
 * This is the EventTrait.
 *
 * @package        Laradic\Support
 * @author         Laradic Dev Team
 * @copyright      Copyright (c) 2015, Laradic
 * @license        https://tldrlegal.com/license/mit-license MIT License
 */
trait StaticEventTrait
{
    /**
     * The event dispatcher instance.
     *
     * @var \Illuminate\Events\Dispatcher
     */
    protected static $dispatcher;

    /**
     * The event dispatcher status.
     *
     * @var bool
     */
    protected static $dispatcherStatus = true;

    /**
     * Returns the event dispatcher.
     *
     * @return \Illuminate\Events\Dispatcher
     */
    public static function getDispatcher()
    {
        return static::$dispatcher;
    }

    /**
     * Sets the event dispatcher instance.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher|\Illuminate\Events\Dispatcher $dispatcher
     * @return $this
     */
    public static function setDispatcher(Dispatcher $dispatcher)
    {
        static::$dispatcher = $dispatcher;

        return static::class;
    }

    /**
     * Returns the event dispatcher status.
     *
     * @return bool
     */
    public static function getDispatcherStatus()
    {
        return static::$dispatcherStatus;
    }

    /**
     * Sets the event dispatcher status.
     *
     * @param  bool $status
     * @return $this
     */
    public static function setDispatcherStatus($status)
    {
        static::$dispatcher = (bool)$status;

        return static::class;
    }

    /**
     * Enables the event dispatcher.
     *
     * @return $this
     */
    public static function enableDispatcher()
    {
        return static::setDispatcherStatus(true);
    }

    /**
     * Disables the event dispatcher.
     *
     * @return $this
     */
    public static function disableDispatcher()
    {
        return static::setDispatcherStatus(false);
    }

    /**
     * Fires an event.
     *
     * @param  string $event
     * @param  mixed  $payload
     * @param  bool   $halt
     * @return mixed
     */
    protected function fireEvent($event, $payload = [ ], $halt = false)
    {
        if (! isset(static::$dispatcher)) {
            static::initEventDispatcher();
        }

        $dispatcher = static::$dispatcher;
        $status     = static::$dispatcherStatus;
        if (! $dispatcher || $status === false) {
            return;
        }
        $method = $halt ? 'until' : 'fire';

        return $dispatcher->{$method}($event, $payload);
    }

    /**
     * Initialize a new Event Dispatcher instance.
     *
     * @return void
     */
    protected static function initEventDispatcher()
    {
        static::setDispatcher(app('events'));
    }
}
