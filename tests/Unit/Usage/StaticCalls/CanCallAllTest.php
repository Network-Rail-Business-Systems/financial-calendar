<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallAllTest extends TestCase
{
    public function test()
    {
        $this->assertIsArray(FinancialCalendar::all('2017-04-03'));
    }
}
