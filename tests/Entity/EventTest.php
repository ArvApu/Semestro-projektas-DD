<?php

namespace App\Tests\Entity;

use App\Entity\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testGetDateMonth()
    {
        $event = new Event();
        $event->setDate(new \DateTime("2019-05-02"));
        $result = $event->getDateMonth();
        $this->assertEquals("Geg",$result);
    }
}
