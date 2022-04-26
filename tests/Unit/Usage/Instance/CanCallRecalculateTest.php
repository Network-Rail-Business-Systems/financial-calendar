<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\Instance;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallRecalculateTest extends TestCase
{
    public function test()
    {
        $calendar = new FinancialCalendar('2017-03-04');
        
        $this->assertInstanceOf(FinancialCalendar::class, $calendar->recalculate());
    }
}
