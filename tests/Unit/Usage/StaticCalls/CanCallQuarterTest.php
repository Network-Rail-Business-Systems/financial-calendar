<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallQuarterTest extends TestCase
{
    public function test()
    {
        $this->assertIsInt(FinancialCalendar::quarter('2017-04-03'));
    }
}
