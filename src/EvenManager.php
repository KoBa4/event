<?php
/**
 * Created by PhpStorm.
 * User: cova4
 * Date: 23.04.2018
 * Time: 20:57
 */

namespace KoBa4\Event;

use KoBa4\PEvent\EventInterface;
use KoBa4\PEvent\EventManagerInterface;

class EvenManager implements EventManagerInterface
{
    /**
     * @var array
     */
    private $events = array();

    /**
     * @inheritdoc
     */
    public function attach($event, $callback, $priority = 0)
    {
        $result = false;
        if ( is_string($event) && is_callable($callback) && is_int($priority) ) {
            if ( !array_key_exists($event, $this->events) || !array_key_exists($priority, $this->events[$event]) ) {
                $this->events[$event][$priority] = [];
            }
            array_push($this->events[$event][$priority], $callback);
            $result = true;
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function detach($event, $callback)
    {
        $result = false;
        if ( array_key_exists($event, $this->events) ) {
            foreach ( $this->events[$event] as $key => $value ) {
                if ( ($finded = array_search($callback, $value)) !== false ) {
                    unset($this->events[$event][$key][$finded]);
                    $result = true;
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function clearListeners($event)
    {
        if ( array_key_exists($event, $this->events) ) {
            unset($this->events[$event]);
        }
    }

    /**
     * @inheritdoc
     */
    public function trigger($event, $target = null, $argv = array())
    {
        if ( is_string($event) ) {
            $event = new Event($event, $target, (array)$argv);
        }

        if ( !($event instanceof EventInterface) ) {
            throw new \InvalidArgumentException('Event must be EventInterface');
        }

        if ( array_key_exists($event->getName(), $this->events) ) {
            ksort($this->events[$event->getName()]);
            foreach ( $this->events[$event->getName()] as $list ) {
                foreach ( $list as $callable ) {
                    call_user_func($callable, $event);
                }
            }
        }

        return $event;
    }
}
