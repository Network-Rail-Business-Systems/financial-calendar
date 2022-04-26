<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallQuarterTest extends TestCase
{
    public function test()
    {
        $this->assertIsInt(FinancialCalendar::quarter('2017-04-03'));
    }
}
