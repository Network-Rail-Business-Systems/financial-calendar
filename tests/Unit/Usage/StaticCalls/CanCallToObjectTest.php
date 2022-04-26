<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallToObjectTest extends TestCase
{
    public function test()
    {
        $this->assertIsObject(FinancialCalendar::toObject('2017-04-03'));
    }
}
