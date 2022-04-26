<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\AcceptedDateFormats;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class WillAcceptYearMonthDayTest extends TestCase
{
    public function test()
    {
        $input = '2017/03/04';
        $output = FinancialCalendar::parse($input)->getDate();

        $this->assertTrue($output->isSameDay($input));
    }
}
