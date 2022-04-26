<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use Carbon\Carbon;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallEndDateForPeriodTest extends TestCase
{
    public function test()
    {
        $this->assertInstanceOf(
            Carbon::class,
            FinancialCalendar::endDateForPeriod(2017, 2)
        );
    }
}
