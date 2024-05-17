<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Getters\GetPeriodStart;

use Carbon\Carbon;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class WillCalculatePeriodStartDateTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals(
            Carbon::parse($start),
            FinancialCalendar::startDateForPeriod($year, $period)
        );
    }
}
