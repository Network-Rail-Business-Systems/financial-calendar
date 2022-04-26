<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallYearTest extends TestCase
{
    public function test()
    {
        $this->assertIsInt(FinancialCalendar::year('2017-04-03'));
    }
}
