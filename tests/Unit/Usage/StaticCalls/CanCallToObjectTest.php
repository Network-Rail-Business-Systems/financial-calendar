<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallToObjectTest extends TestCase
{
    public function test()
    {
        $this->assertIsObject(FinancialCalendar::toObject('2017-04-03'));
    }
}
