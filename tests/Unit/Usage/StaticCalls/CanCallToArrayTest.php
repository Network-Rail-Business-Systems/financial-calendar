<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallToArrayTest extends TestCase
{
    public function test()
    {
        $this->assertIsArray(FinancialCalendar::toArray('2017-04-03'));
    }
}
