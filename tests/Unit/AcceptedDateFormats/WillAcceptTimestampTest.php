<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\AcceptedDateFormats;

use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class WillAcceptTimestampTest extends TestCase
{
    public function test()
    {
        $input = 1491177600000;
        $output = FinancialCalendar::parse($input)->getDate();

        $this->assertEquals($input, $output->getTimestamp());
    }
}
