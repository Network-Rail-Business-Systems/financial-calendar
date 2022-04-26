<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\Instance;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallSetDateTest extends TestCase
{
    public function test()
    {
        $calendar = new FinancialCalendar('2017-03-04');
        
        $this->assertInstanceOf(FinancialCalendar::class, $calendar->setDate('2018-04-03'));
    }
}
