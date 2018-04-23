<?php
/**
 * Created by PhpStorm.
 * User: cova4
 * Date: 23.04.2018
 * Time: 20:56
 */

namespace KoBa4\Event;


use KoBa4\PEvent\EventInterface;

class Event implements EventInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * Event constructor.
     *
     * @param string $name
     * @param null|string|object $target
     * @param array $params
     */
    public function __construct($name, $target = null, array $params = array())
    {
        $this->setName($name);
        $this->setTarget($target);
        $this->setParams($params);
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getTarget()
    {
        // TODO: Implement getTarget() method.
    }

    /**
     * @inheritdoc
     */
    public function getParams()
    {
        // TODO: Implement getParams() method.
    }

    /**
     * @inheritdoc
     */
    public function getParam($name)
    {
        // TODO: Implement getParam() method.
    }

    public function setName($name)
    {
        if ( !is_string($name) )
            throw new \InvalidArgumentException("Name must be string");
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function setTarget($target)
    {
        // TODO: Implement setTarget() method.
    }

    /**
     * @inheritdoc
     */
    public function setParams(array $params)
    {
        // TODO: Implement setParams() method.
    }

    /**
     * @inheritdoc
     */
    public function stopPropagation($flag)
    {
        // TODO: Implement stopPropagation() method.
    }

    /**
     * @inheritdoc
     */
    public function isPropagationStopped()
    {
        // TODO: Implement isPropagationStopped() method.
    }
}
