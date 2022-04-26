<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\Get;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanGetPeriodTest extends TestCase
{
    public function test()
    {
        $calendar = new FinancialCalendar('2017-03-04');

        $this->assertIsInt($calendar->period);
    }
}
