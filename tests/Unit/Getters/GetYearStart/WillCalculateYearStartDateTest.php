<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Getters\GetYearStart;

use Carbon\Carbon;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class WillCalculateYearStartDateTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals(
            Carbon::create($year, 4, 1),
            FinancialCalendar::startDateForYear($year)
        );
    }
}
