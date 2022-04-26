<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Getters\GetPeriodStart;

use Carbon\Carbon;
use ErrorException;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestDates;

class WillCalculatePeriodStartDateTest extends TestDates
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
        $this->assertEquals(
            Carbon::parse($start),
            FinancialCalendar::startDateForPeriod($year, $period)
        );
    }
}
