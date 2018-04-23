<?php
/**
 * Created by PhpStorm.
 * User: cova4
 * Date: 23.04.2018
 * Time: 20:57
 */

namespace KoBa4\Event;

use KoBa4\PEvent\EventManagerInterface;

class EvenManager implements EventManagerInterface
{

    /**
     * @inheritdoc
     */
    public function attach($event, $callback, $priority = 0)
    {
        // TODO: Implement attach() method.
    }

    /**
     * @inheritdoc
     */
    public function detach($event, $callback)
    {
        // TODO: Implement detach() method.
    }

    /**
     * @inheritdoc
     */
    public function clearListeners($event)
    {
        // TODO: Implement clearListeners() method.
    }

    /**
     * @inheritdoc
     */
    public function trigger($event, $target = null, $argv = [])
    {
        // TODO: Implement trigger() method.
    }
}
