<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallAllTest extends TestCase
{
    public function test()
    {
        $this->assertIsArray(FinancialCalendar::all('2017-04-03'));
    }
}
