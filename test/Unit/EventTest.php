<?php
/**
 * Created by PhpStorm.
 * User: cova4
 * Date: 23.04.2018
 * Time: 21:04
 */

namespace KoBa4\Event\Test\Unit;

use KoBa4\Event\Event;

class EventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Event
     */
    private $event;

    protected function setUp()
    {
        parent::setUp();
        $this->event = new Event('test');
    }

    public function testGetName()
    {
        $this->assertSame('test', $this->event->getName());
    }

    public function testSetNameAfterCretion()
    {
        $this->event->setName('aloha');
        $this->assertSame('aloha', $this->event->getName());
    }

    public function providerInvalidNames()
    {
        return array(
            array(array()),
            array(null),
            array(123),
            array(new \stdClass())
        );
    }
    
    /**
     * @dataProvider providerInvalidNames
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Name must be string
     */
    public function testSetNameInvalid($name)
    {
        $this->event->setName($name);
    }

    public function testGetTarget()
    {
        $this->assertSame(null, $this->event->getTarget());
    }

    public function testSetTarget()
    {
        $this->event->setTarget('string');
        $this->assertSame('string', $this->event->getTarget());
    }

    public function providerInvalidTargets()
    {
        return array(
            array(array()),
            array(123)
        );
    }

    /**
     * @dataProvider providerInvalidTargets
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Target must be string or null or object
     */
    public function testSetTargetInvalid($target)
    {
        $this->event->setTarget($target);
    }

    public function testGetParams()
    {
        $this->assertSame(array(), $this->event->getParams());
    }

    public function testSetParams()
    {
        $this->event->setParams(array('string' => 123));
        $this->assertSame(array('string' => 123), $this->event->getParams());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Params key must be string
     */
    public function testSetParamsInvalidArrayKey()
    {
        $this->event->setParams(array(0 => 123));
    }

    public function testGetParam()
    {
        $this->assertSame(null, $this->event->getParam('string'));
    }

    public function testGetParamNotNull()
    {
        $this->event->setParams(array('string' => 'value'));
        $this->assertSame('value', $this->event->getParam('string'));
    }

    public function testStopPropagation()
    {
        $this->assertFalse($this->event->isPropagationStopped());
        $this->event->stopPropagation(true);
        $this->assertTrue($this->event->isPropagationStopped());
    }

    public function providerPropagationInvalid()
    {
        return array(
            array(array()),
            array(123),
            array('string'),
            array(new \stdClass())
        );
    }

    /**
     * @param $value
     * @dataProvider providerPropagationInvalid
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Flag must be bool
     */
    public function testStopPropagationNotBool($value)
    {
        $this->event->stopPropagation($value);
    }
}
