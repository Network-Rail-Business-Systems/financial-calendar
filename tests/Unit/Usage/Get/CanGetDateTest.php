<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Usage\Get;

use Carbon\Carbon;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanGetDateTest extends TestCase
{
    public function test()
    {
        $calendar = new FinancialCalendar('2017-03-04');

        $this->assertInstanceOf(Carbon::class, $calendar->date);
    }
}
