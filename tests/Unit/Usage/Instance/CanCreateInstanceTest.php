<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\Instance;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

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
