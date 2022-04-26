<?php

namespace NRBusinessSystems\FinancialCalendar\Tests\Unit\Usage\Instance;

use Carbon\Carbon;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use NRBusinessSystems\FinancialCalendar\Tests\TestCase;

class CanCallGetYearEndTest extends TestCase
{
    public function test()
    {
        $calendar = new FinancialCalendar('2017-03-04');
        
        $this->assertInstanceOf(Carbon::class, $calendar->getYearEnd(2017));
    }
}
