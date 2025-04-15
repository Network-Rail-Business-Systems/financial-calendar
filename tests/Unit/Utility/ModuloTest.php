<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Utility;

use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;

class ModuloTest extends TestCase
{
    public function test_calculates_remainder(): void
    {
        $calendar = new FinancialCalendar();

        $this->assertEquals(1, $calendar->modulo(4, 3));
        $this->assertEquals(1, $calendar->modulo(-3, 2));
    }
}
