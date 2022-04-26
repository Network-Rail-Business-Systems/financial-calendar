<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\AcceptedDateFormats;

use DateTime;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class WillAcceptDateTimeTest extends TestCase
{
    public function test()
    {
        $input = new DateTime('2017-03-04');
        $output = FinancialCalendar::parse($input)->getDate();

        $this->assertTrue($output->isSameDay($input));
    }
}
