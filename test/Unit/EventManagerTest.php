<?php
/**
 * Created by PhpStorm.
 * User: cova4
 * Date: 23.04.2018
 * Time: 21:07
 */

namespace KoBa4\Event\Test\Unit;

use KoBa4\Event\EvenManager;
use KoBa4\PEvent\EventInterface;

class EventManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EvenManager
     */
    private $manager;
    /**
     * @var callable
     */
    private $callback;

    public function setUp()
    {
        parent::setUp();

        $this->manager = new EvenManager();
        $this->callback = function (EventInterface $event) {
            static $magic = 0;
            return ++$magic;
        };
    }

    public function testAttach()
    {
        $this->assertTrue($this->manager->attach('magic', $this->callback));
    }

    public function testDetach()
    {
        $this->assertFalse($this->manager->detach('magic', $this->callback));
        $this->manager->attach('magic', $this->callback);
        $this->assertTrue($this->manager->attach('magic', $this->callback));
    }

    public function testClearListeners()
    {
        $this->manager->attach('magic', $this->callback);
        $this->manager->clearListeners('magic');
        $this->assertFalse($this->manager->detach('magic', $this->callback));
    }

    public function testTrigger()
    {
        $this->manager->attach('magic', $this->callback);

        /** @var EventInterface $event */
        $event = $this->manager->trigger('magic');
        $this->assertSame('magic', $event->getName());
        $this->assertSame(2, call_user_func($this->callback, $this->getMockBuilder(EventInterface::class)->getMock()));
    }
}
