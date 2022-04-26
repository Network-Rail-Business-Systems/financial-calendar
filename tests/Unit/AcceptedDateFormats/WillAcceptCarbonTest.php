<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\AcceptedDateFormats;

use Carbon\Carbon;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class WillAcceptCarbonTest extends TestCase
{
    public function test()
    {
        $input = Carbon::create(2017, 03, 04);
        $output = FinancialCalendar::parse($input)->getDate();
        
        $this->assertTrue($output ->isSameDay($input));
    }
}
