<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallParseTest extends TestCase
{
    public function test()
    {
        $this->assertTrue(is_a(FinancialCalendar::parse('2017-04-03'), FinancialCalendar::class));
    }
}
