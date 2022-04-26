<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Utility\NextWeek;

use ErrorException;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestDates;

class WillMoveToNextWeekInYearTest extends TestDates
{
    /**
     * @dataProvider dates
     * @param string $start
     * @param string $end
     * @param int $year
     * @param int $quarter
     * @param int $period
     * @param int $weekInYear
     * @throws ErrorException
     */
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
