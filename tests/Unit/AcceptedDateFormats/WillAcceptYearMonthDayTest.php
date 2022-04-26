<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\AcceptedDateFormats;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class WillAcceptYearMonthDayTest extends TestCase
{
    public function test()
    {
        $input = '2017/03/04';
        $output = FinancialCalendar::parse($input)->getDate();

        $this->assertTrue($output->isSameDay($input));
    }
}
