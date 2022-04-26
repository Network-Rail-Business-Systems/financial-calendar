<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests;

use NetworkRailBusinessSystems\FinancialCalendar\Tests\Data\FinancialDates;

abstract class TestDates extends TestCase
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
    abstract public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void;

    public function dates(): array
    {
        return FinancialDates::DATES;
    }
}
