<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Getters\GetYearStart;

use Carbon\Carbon;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class WillCalculateYearStartDateTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $this->assertEquals(
            Carbon::create($year, 4),
            FinancialCalendar::startDateForYear($year)
        );
    }

    public function testOverridesYearStart(): void
    {
        $calendar = new FinancialCalendar();
        $calendar->setYearStartOverrides([
            2024 => [7, 19],
        ]);

        $this->assertEquals(
            Carbon::create(2024, 7, 19),
            $calendar->getYearStart(2024),
        );
    }
}
