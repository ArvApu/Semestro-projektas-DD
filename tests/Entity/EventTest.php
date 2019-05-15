<?php

namespace App\Tests\Entity;

use App\Entity\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testGetDateMonth()
    {
        $months = ["Sau","Vas","Kov","Bal","Geg","Bir","Lie","Rgp","Rgs","Spa","Lap","Gru"];
        $event = new Event();

        $i = 1;
        foreach ($months as $month)
        {
            $result = $event->getDateMonth($i++);
            $this->assertEquals($month,$result);
        }

    }
}
