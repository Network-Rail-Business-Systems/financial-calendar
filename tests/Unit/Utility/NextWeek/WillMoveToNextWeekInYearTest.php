<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Utility\NextWeek;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class WillMoveToNextWeekInYearTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $calendar = FinancialCalendar::parse($start);

        $calendar->nextWeek();
        $this->assertEquals($weekInYear + 1, $calendar->weekInYear);

        $calendar->nextWeek();
        $this->assertEquals($weekInYear + 2, $calendar->weekInYear);

        $calendar->nextWeek();
        $this->assertEquals($weekInYear + 3, $calendar->weekInYear);
    }
}
