<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Calculation\Quarter;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class CanCalculateQuarterTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals($quarter, FinancialCalendar::quarter($start), "Start date $start failed");

        $this->assertEquals($quarter, FinancialCalendar::quarter($end), "End date $end failed");
    }
}
