<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\Instance;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCreateInstanceTest extends TestCase
{
    public function test()
    {
        $this->assertInstanceOf(
            FinancialCalendar::class,
            new FinancialCalendar('2017-04-03')
        );
    }
}
