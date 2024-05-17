<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Getters\GetPeriodEnd;

use Carbon\Carbon;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class WillCalculatePeriodEndDateTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals(
            Carbon::parse($end),
            FinancialCalendar::endDateForPeriod($year, $period)
        );
    }
}
