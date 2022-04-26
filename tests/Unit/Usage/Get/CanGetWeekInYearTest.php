<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\Get;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanGetWeekInYearTest extends TestCase
{
    public function test()
    {
        $calendar = new FinancialCalendar('2017-03-04');

        $this->assertIsInt($calendar->weekInYear);
    }
}
