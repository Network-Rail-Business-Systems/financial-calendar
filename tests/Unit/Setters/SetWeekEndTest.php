<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Setters;

use Carbon\CarbonInterface;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class SetWeekEndTest extends TestCase
{
    #[DataProvider('dates')]
    public function testSetsWeekEnd(int $start, int $end): void
    {
        $calendar = new FinancialCalendar();
        $calendar->setWeekEnd($end);
        
        $this->assertEquals($start, $calendar->dayWeekStarts);
        $this->assertEquals($end, $calendar->dayWeekEnds);
    }
    
    public static function dates(): array
    {
        return [
            ['start' => CarbonInterface::MONDAY, 'end' => CarbonInterface::SUNDAY],
            ['start' => CarbonInterface::TUESDAY, 'end' => CarbonInterface::MONDAY],
            ['start' => CarbonInterface::WEDNESDAY, 'end' => CarbonInterface::TUESDAY],
            ['start' => CarbonInterface::THURSDAY, 'end' => CarbonInterface::WEDNESDAY],
            ['start' => CarbonInterface::FRIDAY, 'end' => CarbonInterface::THURSDAY],
            ['start' => CarbonInterface::SATURDAY, 'end' => CarbonInterface::FRIDAY],
            ['start' => CarbonInterface::SUNDAY, 'end' => CarbonInterface::SATURDAY],
        ];
    }
}
