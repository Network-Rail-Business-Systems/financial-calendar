<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\AcceptedDateFormats;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class WillAcceptMySQLTest extends TestCase
{
    public function test()
    {
        $input = '2017-03-04 12:15:48';
        $output = FinancialCalendar::parse($input)->getDate();

        $this->assertTrue($output->isSameDay($input));
    }
}
