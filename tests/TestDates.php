<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests;

use NetworkRailBusinessSystems\FinancialCalendar\Tests\Data\FinancialDates;
use PHPUnit\Framework\Attributes\DataProvider;

abstract class TestDates extends TestCase
{
    #[DataProvider('dates')]
    abstract public function test(string $start, string $end, int $year, int $quarter, int $period, int $weekInYear): void;

    public static function dates(): array
    {
        return FinancialDates::DATES;
    }
}
