<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use Carbon\Carbon;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallStartDateForPeriodTest extends TestCase
{
    public function test()
    {
        $this->assertInstanceOf(
            Carbon::class,
            FinancialCalendar::startDateForPeriod(2017, 5)
        );
    }
}
