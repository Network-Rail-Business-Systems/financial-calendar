<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Calculation\Year;

use ErrorException;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;

class CanCalculateYearTest extends TestDates
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
        $this->assertEquals($year, FinancialCalendar::year($start), "Start date $start failed");
       
        $this->assertEquals($year, FinancialCalendar::year($end), "End date $end failed");
    }
}
