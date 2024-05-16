<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Calculation\WeekInYear;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class CanCalculateWeekInYearTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals($weekInYear, FinancialCalendar::weekInYear($start), "Start date $start failed");

        $this->assertEquals($weekInYear + 3, FinancialCalendar::weekInYear($end), "End date $end failed");
    }
    
    public function testHandlesAdjustedWeekLength(): void
    {
        $calendar = new FinancialCalendar();
        $calendar->setWeekLengthOverrides([
            2024 => [
                16 => 6,
            ],
        ]);
        
        $calendar->setDate('2024-07-19');
        $this->assertEquals(16, $calendar->weekInYear);

        $calendar->setDate('2024-07-20');
        $this->assertEquals(17, $calendar->weekInYear);
    }
}
