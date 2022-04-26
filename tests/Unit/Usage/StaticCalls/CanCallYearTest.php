<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallYearTest extends TestCase
{
    public function test()
    {
        $this->assertIsInt(FinancialCalendar::year('2017-04-03'));
    }
}
