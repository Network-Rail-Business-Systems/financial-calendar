<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Getters\GetYearEnd;

use Carbon\Carbon;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class WillCalculateYearEndDateTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals(
            Carbon::create($year + 1, 3, 31),
            FinancialCalendar::endDateForYear($year)
        );
    }
}
