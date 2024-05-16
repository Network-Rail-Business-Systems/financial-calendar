<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Calculation\WeekInYear;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class CanCalculateWeekInYearTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals($weekInYear, FinancialCalendar::weekInYear($start), "Start date $start failed");

        $this->assertEquals($weekInYear + 3, FinancialCalendar::weekInYear($end), "End date $end failed");
    }
}
