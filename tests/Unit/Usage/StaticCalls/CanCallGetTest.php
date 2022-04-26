<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallGetTest extends TestCase
{
    public function test()
    {
        $this->assertInstanceOf(
            FinancialCalendar::class,
            FinancialCalendar::now()
        );
    }
}
