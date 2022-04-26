<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use Carbon\Carbon;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallStartDateForYearTest extends TestCase
{
    public function test()
    {
        $this->assertInstanceOf(
            Carbon::class,
            FinancialCalendar::startDateForYear(2017)
        );
    }
}
