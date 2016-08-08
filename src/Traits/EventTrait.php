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
trait EventTrait
{
    /**
     * The event dispatcher instance.
     *
     * @var \Illuminate\Events\Dispatcher
     */
    protected $dispatcher;

    /**
     * The event dispatcher status.
     *
     * @var bool
     */
    protected $dispatcherStatus = true;

    /**
     * Returns the event dispatcher.
     *
     * @return \Illuminate\Events\Dispatcher
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * Sets the event dispatcher instance.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher|\Illuminate\Events\Dispatcher $dispatcher
     * @return $this
     */
    public function setDispatcher(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;

        return $this;
    }

    /**
     * Returns the event dispatcher status.
     *
     * @return bool
     */
    public function getDispatcherStatus()
    {
        return $this->dispatcherStatus;
    }

    /**
     * Sets the event dispatcher status.
     *
     * @param  bool $status
     * @return $this
     */
    public function setDispatcherStatus($status)
    {
        $this->dispatcherStatus = (bool)$status;

        return $this;
    }

    /**
     * Enables the event dispatcher.
     *
     * @return $this
     */
    public function enableDispatcher()
    {
        return $this->setDispatcherStatus(true);
    }

    /**
     * Disables the event dispatcher.
     *
     * @return $this
     */
    public function disableDispatcher()
    {
        return $this->setDispatcherStatus(false);
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
        if (! isset($this->dispatcher)) {
            $this->initEventDispatcher();
        }

        $dispatcher = $this->dispatcher;
        $status     = $this->dispatcherStatus;
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
    protected function initEventDispatcher()
    {
        $this->setDispatcher(app('events'));
    }
}
