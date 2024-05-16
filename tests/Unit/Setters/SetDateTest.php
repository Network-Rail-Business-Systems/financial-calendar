<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Tests\Unit\Setters;

use Carbon\Carbon;
use DateTime;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;
use NetworkRailBusinessSystems\FinancialCalendar\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class SetDateTest extends TestCase
{
    protected Carbon $now;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->now = Carbon::create(2024, 7, 19, 12, 32, 05);
        Carbon::setTestNow($this->now);
    }

    #[DataProvider('dates')]
    public function testSetsFromString(string|int|DateTime|Carbon $date, ?string $format): void
    {
        $calendar = new FinancialCalendar();
        $calendar->setDate($date, $format);
        
        $this->assertEquals(
            $this->now,
            $calendar->date,
        );
    }

    public static function dates(): array
    {
        $now = Carbon::create(2024, 7, 19, 12, 32, 05);
        
        return [
            'String' => ['date' => $now->toIso8601String(), 'format' => null],
            'String with format' => ['date' => $now->format('d/m/Y H:i:s'), 'format' => 'd/m/Y H:i:s'],
            'Integer' => ['date' => $now->timestamp, 'format' => null],
            'Carbon' => ['date' => $now, 'format' => null],
            'DateTime' => ['date' => $now->toDateTime(), 'format' => null],
        ];
    }
}
