<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\AcceptedDateFormats;

use DateTime;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class WillAcceptDateTimeTest extends TestCase
{
    public function test()
    {
        $input = new DateTime('2017-03-04');
        $output = FinancialCalendar::parse($input)->getDate();

        $this->assertTrue($output->isSameDay($input));
    }
}
