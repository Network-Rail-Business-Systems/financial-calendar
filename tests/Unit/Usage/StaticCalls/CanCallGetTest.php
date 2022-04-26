<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

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
