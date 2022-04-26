<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\StaticCalls;

use Carbon\Carbon;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallEndDateForYearTest extends TestCase
{
    public function test()
    {
        $this->assertInstanceOf(
            Carbon::class,
            FinancialCalendar::endDateForYear(2017)
        );
    }
}
