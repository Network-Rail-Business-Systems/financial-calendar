<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Calculation\WeekInPeriod;

use Carbon\Carbon;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestDates;
use PHPUnit\Framework\Attributes\DataProvider;

class CanCalculateWeekInPeriodTest extends TestDates
{
    #[DataProvider('dates')]
    public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void
    {
        $start = Carbon::parse($start);

        $this->assertEquals(1, FinancialCalendar::weekInPeriod($start), "Start date $start failed");

        // TODO Could be a juicy way to revise the week calculation!
        $next = Carbon::parse($start)->next(Carbon::SUNDAY);
        if ($start->diffInDays($next) < 5) {
            $start->next(Carbon::SUNDAY);
        }

        $start->next(Carbon::SUNDAY);
        $this->assertEquals(2, FinancialCalendar::weekInPeriod($start), "Start date $start failed");

        $start->next(Carbon::SUNDAY);
        $this->assertEquals(3, FinancialCalendar::weekInPeriod($start), "Start date $start failed");

        $start->next(Carbon::SUNDAY);
        $this->assertEquals(4, FinancialCalendar::weekInPeriod($start), "Start date $start failed");
    }
}
