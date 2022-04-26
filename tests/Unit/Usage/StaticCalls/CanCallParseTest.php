<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallParseTest extends TestCase
{
    public function test()
    {
        $this->assertTrue(is_a(FinancialCalendar::parse('2017-04-03'), FinancialCalendar::class));
    }
}
