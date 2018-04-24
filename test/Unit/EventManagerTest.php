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
        $this->callback = function () {
            static $magic = 0;
            return ++$magic;
        };
    }

    public function testAttach()
    {
        $this->assertTrue($this->manager->attach('magic', $this->callback));
    }

    public function testAttachWithPriority()
    {
        $this->assertTrue($this->manager->attach('magic', $this->callback, 0));
    }

    public function testAttachInvalidEvent()
    {
        $this->assertFalse($this->manager->attach(123, $this->callback));
    }

    public function testAttachInvalidCallback()
    {
        $this->assertFalse($this->manager->attach('magic', '54613215'));
    }

    public function testAttachInvalidPriority()
    {
        $this->assertFalse($this->manager->attach('magic', $this->callback, 'string'));
    }

    public function testDetach()
    {
        $this->assertFalse($this->manager->detach('magic', $this->callback));
        $this->manager->attach('magic', $this->callback);
        $this->assertTrue($this->manager->attach('magic', $this->callback));
    }

    public function testDetachInvalidEvent()
    {
        $this->assertFalse($this->manager->detach(123, $this->callback));
    }

    public function testDetachInvalidCallback()
    {
        $this->assertFalse($this->manager->detach('magic', '54613215'));
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

    public function testTriggerEventInterface()
    {
        $event = $this->getMockBuilder(EventInterface::class)->getMock();
        $event->expects($this->atLeast(1))
            ->method('getName')->willReturn('magic');
        $this->manager->attach('magic', $this->callback);

        /** @var EventInterface $event */
        $event = $this->manager->trigger($event);
        $this->assertSame('magic', $event->getName());
        $this->assertSame(2, call_user_func($this->callback, $this->getMockBuilder(EventInterface::class)->getMock()));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Event must be EventInterface
     */
    public function testTriggerNotValidEvent()
    {
        $this->manager->trigger(123);
    }
}
