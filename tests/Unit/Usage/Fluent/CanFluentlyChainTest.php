<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\Fluent;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanFluentlyChainTest extends TestCase
{
    public function test()
    {
        $calendar = new FinancialCalendar('2017-04-03');
        
        $this->assertInstanceOf(
            FinancialCalendar::class,
            $calendar->setShortWeekLimit(3)
            -> setYearStart(5, 2)
            -> setWeekEnd(4)
            -> setDate('2018-08-12')
            -> setWeekLengthOverrides([2019 => [1 => 13]])
            -> setYearStartOverrides([2019 => [3, 12]])
            -> recalculate()
            -> nextPeriod()
            -> nextWeek()
        );
    }
}
