<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Utility\NextPeriod;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class WillMoveToNextPeriodTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $calendar = FinancialCalendar::parse($start);

        $calendar->nextPeriod();
        $this->assertEquals(
            $period === FinancialCalendar::PERIODS_PER_YEAR ? 1 : $period + 1,
            $calendar->period
        );
    }
}
