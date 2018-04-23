<?php
/**
 * Created by PhpStorm.
 * User: cova4
 * Date: 23.04.2018
 * Time: 21:04
 */

namespace KoBa4\Event\Test\Unit;

use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testFail()
    {
        $this->assertFalse(false);
    }
}
