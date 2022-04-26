<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\AcceptedDateFormats;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class WillAcceptTimestampTest extends TestCase
{
    public function test()
    {
        $input = 1491177600000;
        $output = FinancialCalendar::parse($input)->getDate();

        $this->assertEquals($input, $output->getTimestamp());
    }
}
