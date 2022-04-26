<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Utility\NextPeriod;

use ErrorException;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestDates;

class WillMoveToNextPeriodTest extends TestDates
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

        $calendar->nextPeriod();
        $this->assertEquals(
            $period === FinancialCalendar::PERIODS_PER_YEAR ? 1 : $period + 1,
            $calendar->period
        );
    }
}
