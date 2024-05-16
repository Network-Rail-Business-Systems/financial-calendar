<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Calculation\Period;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class CanCalculatePeriodTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals($period, FinancialCalendar::period($start), "Start date $start failed");

        $this->assertEquals($period, FinancialCalendar::period($end), "End date $end failed");
    }
}
