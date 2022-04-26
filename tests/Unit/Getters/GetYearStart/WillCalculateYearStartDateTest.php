<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Getters\GetYearStart;

use Carbon\Carbon;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestDates;

class WillCalculateYearStartDateTest extends TestDates
{
    /**
     * @dataProvider dates
     * @param string $start
     * @param string $end
     * @param int $year
     * @param int $quarter
     * @param int $period
     * @param int $weekInYear
     */
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals(
            Carbon::create($year, 4, 1),
            FinancialCalendar::startDateForYear($year)
        );
    }
}
