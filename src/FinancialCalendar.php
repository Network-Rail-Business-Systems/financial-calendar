<?php

namespace NetworkRailBusinessSystems\FinancialCalendar;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTime;
use ErrorException;
use stdClass;

/**
 * @property-read Carbon $date A copy of the current working calendar
 * @property-read int $period The calculated financial period
 * @property-read int $quarter The calculated financial quarter
 * @property-read int $shortWeekLimit The current short week limit
 * @property-read int $weekInPeriod The calculated financial week in period
 * @property-read int $weekInYear The calculated financial week in year
 * @property-read int $year The calculated financial year
 */
class FinancialCalendar
{
    const PERIODS_PER_YEAR = 13;

    const WEEKS_PER_YEAR = 52;

    protected Carbon $calendar;

    protected int $year;

    protected int $weekInYear;

    protected int $quarter;

    protected int $period;

    protected int $weekInPeriod;

    protected int $dayWeekStarts = 0;

    protected int $dayWeekEnds = 6;

    /** @var int[] The day on which the financial year begins */
    protected array$yearStart = [4, 1];

    /** @var array<int, int[]> An array of year-start dates that override the default above (year => [month, day]) */
    protected array $yearStartOverrides = [];

    /** @var array<int, array<int, int>> An array of period weeks that override the default 7-day length (year => [week => length]) */
    protected array $weekLengthOverrides = [];

    /** @var int How short the first week of a financial year can be before being extended */
    protected int $shortWeekLimit = 5;

    // Construction
    public function __construct(string|int|Carbon|DateTime $date = null, ?string $format = null)
    {
        $this->calendar = new Carbon;

        if ($date !== null) {
            $this->setDate($date, $format);
        }
    }

    public function __get(string $key): int|Carbon
    {
        return match ($key) {
            'date' => $this->getDate(),
            
            'p',
            'period' => $this->period,
            
            'q',
            'quarter' => $this->quarter,
            
            'shortWeekLimit' => $this->shortWeekLimit,
            
            'wip',
            'weekInPeriod',
            'week_in_period' => $this->weekInPeriod,
            
            'wiy',
            'weekInYear',
            'week_in_year' => $this->weekInYear,
            
            'y',
            'year' => $this->year,
            
            default => throw new ErrorException("$key is not an accessible property"),
        };
    }
    
    // Static Methods
    /** @return array<string, int> */
    public static function all(string|int|Carbon|DateTime $date, ?string $format = null): array
    {
        $calendar = new FinancialCalendar($date, $format);
        return $calendar->asArray();
    }
    
    /** @return array<string, int> */
    public static function toArray(string|int|Carbon|DateTime $date, ?string $format = null): array
    {
        $calendar = new FinancialCalendar($date, $format);
        return $calendar->asArray();
    }
    
    public static function toObject(string|int|Carbon|DateTime $date, ?string $format = null): stdClass
    {
        $calendar = new FinancialCalendar($date, $format);
        return $calendar->asObject();
    }
    
    public static function parse(string|int|Carbon|DateTime $date, ?string $format = null): self
    {
        return new FinancialCalendar($date, $format);
    }
    
    public static function period(string|int|Carbon|DateTime $date, ?string $format = null): int
    {
        $calendar = new FinancialCalendar($date, $format);
        return $calendar->period;
    }
    
    public static function quarter(string|int|Carbon|DateTime $date, ?string $format = null): int
    {
        $calendar = new FinancialCalendar($date, $format);
        return $calendar->quarter;
    }

    public static function weekInPeriod(string|int|Carbon|DateTime $date, ?string $format = null): int
    {
        $calendar = new FinancialCalendar($date, $format);
        return $calendar->weekInPeriod;
    }
    
    public static function weekInYear(string|int|Carbon|DateTime $date, ?string $format = null): int
    {
        $calendar = new FinancialCalendar($date, $format);
        return $calendar->weekInYear;
    }
    
    public static function year(string|int|Carbon|DateTime $date, ?string $format = null): int
    {
        $calendar = new FinancialCalendar($date, $format);
        return $calendar->year;
    }
    
    public static function startDateForYear(int $year): Carbon
    {
        $calendar = new FinancialCalendar();
        return $calendar->getYearStart($year);
    }
    
    public static function endDateForYear(int $year): Carbon
    {
        $calendar = new FinancialCalendar();
        return $calendar->getYearEnd($year);
    }
    
    public static function startDateForPeriod(int $year, int $period): Carbon
    {
        $calendar = new FinancialCalendar();
        return $calendar->getPeriodStart($year, $period);
    }
    
    public static function endDateForPeriod(int $year, int $period): Carbon
    {
        $calendar = new FinancialCalendar();
        return $calendar->getPeriodEnd($year, $period);
    }
    
    public static function now(): self
    {
        return new FinancialCalendar(Carbon::now());
    }

    // Getters
    /** @return array<string, int> */
    public function asArray(): array
    {
        return [
            'year' => $this->year,
            'week_in_year' => $this->weekInYear,
            'quarter' => $this->quarter,
            'period' => $this->period,
            'week_in_period' => $this->weekInPeriod,
        ];
    }
    
    public function asObject(): stdClass
    {
        return (object) $this->asArray();
    }
    
    public function getWeekEnd(): int
    {
        return $this->calendar->getWeekEndsAt();
    }
    
    public function getDate(): Carbon
    {
        return $this->calendar->copy();
    }
    
    public function getYearStart(int $year): Carbon
    {
        if (isset($this->yearStartOverrides[$year]) === true) {
            $yearStart = $this->yearStartOverrides[$year];
        } else {
            $yearStart = $this->yearStart;
        }

        return Carbon::create($year, $yearStart[0], $yearStart[1])
            ?? throw new ErrorException("Unable to create Carbon instance for $year");
    }
    
    public function getYearEnd(int $year): Carbon
    {
        return $this->getYearStart($year + 1)->subDay();
    }
    
    public function getPeriodStart(int $year, int $period): Carbon
    {
        $calendar = FinancialCalendar::parse(self::getYearStart($year));

        while ($calendar->period !== $period) {
            $calendar->nextPeriod();
        }

        return $calendar->date;
    }
    
    public function getPeriodEnd(int $year, int $period): Carbon
    {
        if ($period >= self::PERIODS_PER_YEAR) {
            $year++;
            $period = 1;
        } else {
            $period++;
        }

        return $this->getPeriodStart($year, $period)->subDay();
    }

    // Setters
    /** @param array<int, array<int, int>> $overrides */
    public function setWeekLengthOverrides(array $overrides): self
    {
        $this->weekLengthOverrides = $overrides;
        return $this;
    }
    
    /** @param array<int, int[]> $overrides */
    public function setYearStartOverrides(array $overrides): self
    {
        $this->yearStartOverrides = $overrides;
        return $this;
    }
    
    public function setYearStart(int $month, int $day): self
    {
        $this->yearStart = [$month, $day];
        return $this;
    }
    
    public function setWeekEnd(int $day): self
    {
        $this->dayWeekEnds = $day;

        $this->dayWeekStarts = $day + 1 <= CarbonInterface::SATURDAY
            ? $day + 1
            : CarbonInterface::SUNDAY;

        return $this;
    }
    
    public function setDate(string|int|Carbon|DateTime $date, ?string $format = null): self
    {
        $date = match (gettype($date)) {
            'object' => is_a($date, Carbon::class) === true
                ? $date->timestamp
                : $date->getTimestamp(),
            'string' => $format !== null
                ? Carbon::createFromFormat($format, $date)?->getTimestamp()
                    ?? throw new ErrorException("\"$date\" is either invalid or does not match the \"$format\" format")
                : Carbon::parse($date)->getTimestamp(),
            default => $date,
        };

        $this->calendar->timestamp($date);
        $this->calculate();

        return $this;
    }
    
    public function setShortWeekLimit(int $limit): self
    {
        $this->shortWeekLimit = $limit;
        return $this;
    }

    // Utility
    public function recalculate(): self
    {
        $this->calculate();
        return $this;
    }
    
    protected function daysUntilStartOfWeek(Carbon $date): int
    {
        $days = 0;
        $date = $date->copy();

        while ($date->dayOfWeek !== $this->dayWeekEnds) {
            $date->addDay();
            $days++;
        }

        return $days + 1;
    }
    
    public function nextPeriod(): self
    {
        $target = $this->period === self::PERIODS_PER_YEAR
            ? 1
            : $this->period + 1;

        while ($this->period !== $target) {
            $this->nextWeek();
        }

        return $this;
    }
    
    public function nextWeek(): self
    {
        $target = $this->weekInYear === self::WEEKS_PER_YEAR
            ? 1
            : $this->weekInYear + 1;

        while ($this->weekInYear !== $target) {
            $this->calendar->next($this->dayWeekStarts);
            $this->recalculate();
        }

        return $this;
    }
    
    protected function modulo(int $value, int $dividend): int
    {
        $output = $value % $dividend;

        if ($output < 0) {
            return $output + $dividend;
        }

        return $output;
    }

    // Calculation
    protected function calculate(): void
    {
        $this->year = $this->calculateYear();
        $this->weekInYear = $this->calculateWeekInYear($this->year);
        $this->period = $this->calculatePeriod($this->weekInYear);
        $this->weekInPeriod = $this->calculateWeekInPeriod($this->weekInYear);
        $this->quarter = $this->calculateQuarter($this->period);
    }

    protected function calculateYear(): int
    {
        $yearStart = $this->getYearStart($this->calendar->year);

        if ($this->calendar->isBefore($yearStart)) {
            return $this->calendar->year - 1;
        }

        return $this->calendar->year;
    }

    protected function calculateWeekInYear(int $year): int
    {
        $week = 1;
        $workingDate = $this->getYearStart($year);

        if (isset($this->weekLengthOverrides[$year]) === true) {
            $adjustedWeekLengths = $this->weekLengthOverrides[$year];
        } else {
            $adjustedWeekLengths = [];
        }

        if (isset($adjustedWeekLengths[1]) === false) {
            $daysToNextWeek = $this->daysUntilStartOfWeek($workingDate);

            if ($daysToNextWeek > 0) {
                if ($daysToNextWeek < $this->shortWeekLimit) {
                    $adjustedWeekLengths[1] = $daysToNextWeek + 7;
                } else {
                    $adjustedWeekLengths[1] = $daysToNextWeek;
                }
            }
        }

        while ($this->calendar->isAfter($workingDate) === true) {
            if (isset($adjustedWeekLengths[$week]) === true) {
                $workingDate->addDays($adjustedWeekLengths[$week]);
            } else {
                $workingDate->next($this->dayWeekStarts);
            }

            $week++;
        }

        if ($week > self::WEEKS_PER_YEAR) {
            return self::WEEKS_PER_YEAR;
        }

        if ($this->calendar->isBefore($workingDate) === true) {
            return $week - 1;
        }

        return $week;
    }
    
    protected function calculateQuarter(int $period): int
    {
        $quarter = ceil($period / 3);

        if ($quarter > 4) {
            return 4;
        }

        return (int) $quarter;
    }
    
    protected function calculatePeriod(int $weekInYear): int
    {
        return (int) ceil($weekInYear * 0.25);
    }
    
    protected function calculateWeekInPeriod(int $weekInYear): int
    {
        $week = $this->modulo($weekInYear, 4);

        if ($week === 0) {
            return 4;
        }

        return $week;
    }
}
