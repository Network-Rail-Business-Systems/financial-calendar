<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Calculation\Year;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class CanCalculateYearTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals($year, FinancialCalendar::year($start), "Start date $start failed");

        $this->assertEquals($year, FinancialCalendar::year($end), "End date $end failed");
    }
}
