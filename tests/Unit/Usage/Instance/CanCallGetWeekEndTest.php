<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\Instance;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallGetWeekEndTest extends TestCase
{
    public function test()
    {
        $calendar = new FinancialCalendar('2017-03-04');
        
        $this->assertIsInt($calendar->getWeekEnd());
    }
}
