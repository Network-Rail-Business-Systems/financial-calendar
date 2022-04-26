<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallToArrayTest extends TestCase
{
    public function test()
    {
        $this->assertIsArray(FinancialCalendar::toArray('2017-04-03'));
    }
}
