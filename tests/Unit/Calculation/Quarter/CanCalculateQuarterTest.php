<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Calculation\Quarter;

use ErrorException;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;

class CanCalculateQuarterTest extends TestDates
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
        $this->assertEquals($quarter, FinancialCalendar::quarter($start), "Start date $start failed");

        $this->assertEquals($quarter, FinancialCalendar::quarter($end), "End date $end failed");
    }
}
