<?php

namespace NetworkRailBusinessSystems\FinancialCalendar;

use Carbon\Carbon;
use DateTime;
use ErrorException;
use Throwable;
use stdClass;

class FinancialCalendar
{
    const PERIODS_PER_YEAR = 13;
    const WEEKS_PER_YEAR = 52;
    
    /** @var Carbon A carbon instance that holds the calendar information */
    protected $calendar;
    
    /** @var int The calculated financial year */
    protected $year;
    
    /** @var int The calculated week in the financial year */
    protected $weekInYear;
    
    /** @var int The calculated quarter of the financial year */
    protected $quarter;
    
    /** @var int The calculated period of the financial year */
    protected $period;
    
    /** @var int The calculated week of the financial period */
    protected $weekInPeriod;

    /** @var int The day on which a working week ends */
    protected $dayWeekStarts = 0;
    
    /** @var int The day on which a working week ends */
    protected $dayWeekEnds = 6;
    
    /** @var array The day on which the financial year begins */
    protected $yearStart = [4, 1];
    
    /** @var array An array of year-start dates that override the default above (year => [month, day]) */
    protected $yearStartOverrides = [];
    
    /** @var array An array of period weeks that override the default 7-day length (year => [week => length]) */
    protected $weekLengthOverrides = [];
    
    /** @var int How short the first week of a financial year can be before being extended */
    protected $shortWeekLimit = 5;

    // Construction
        /**
         * Creates a new instance of the Financial Calendar
         * @param string|int|Carbon|DateTime $date The date to parse, or object to inherit
         * @param string $format The string format to parse ('y-M-D')
         * @return self
         * @throws Throwable
         */
        public function __construct($date = null, string $format = null)
        {
            $this->calendar = new Carbon;

            if ($date !== null) {
                $this->setDate($date, $format);
            }
            
            return $this;
        }
        
    // Static Methods
        /**
         * Generate a static output for the given key
         * @param string $key The field to return from the static method
         * @param string|int|Carbon|DateTime $date The date to parse
         * @param string $format The format of the date
         * @return array|int|stdClass|self The calculated values
         * @throws Throwable
         * @throws Throwable
         */
        protected static function fromStatic(string $key, $date, string $format = null)
        {
            $calendar = new FinancialCalendar($date, $format);
    
            switch ($key)
            {
                case 'array':
                    return $calendar->asArray();
    
                case 'object':
                    return $calendar->asObject();
    
                case 'parse':
                    return $calendar;
    
                case 'period':
                    return $calendar->period;
    
                case 'quarter':
                    return $calendar->quarter;
    
                case 'weekInPeriod':
                    return $calendar->weekInPeriod;
    
                case 'weekInYear':
                    return $calendar->weekInYear;
    
                case 'year':
                    return $calendar->year;
    
                default:
                    throw new ErrorException("$key is not an available static method");
            }
        }
    
        /**
         * Retrieve an associative array containing the calendar details for the given date
         * @param string|int|Carbon|DateTime $date The date to parse
         * @param string $format The format of the date
         * @return array
         * @throws Throwable
         */
        public static function all($date, string $format = null): array
        {
            return FinancialCalendar::fromStatic('array', $date, $format);
        }
        
        /**
         * Retrieve an associative array containing the calendar details for the given date
         * @param string|int|Carbon|DateTime $date The date to parse
         * @param string $format The format of the date
         * @return array
         * @throws Throwable
         */
        public static function toArray($date, string $format = null): array
        {
            return FinancialCalendar::fromStatic('array', $date, $format);
        }

        /**
         * Retrieve an object containing the calendar details for the given date
         * @param string|int|Carbon|DateTime $date The date to parse
         * @param string $format The format of the date
         * @return stdClass
         * @throws Throwable
         */
        public static function toObject($date, string $format = null): stdClass
        {
            return FinancialCalendar::fromStatic('object', $date, $format);
        }

        /**
         * Retrieve an instance of Financial Calendar for the given date
         * @param string|int|Carbon|DateTime $date The date to parse
         * @param string $format The format of the date
         * @return self
         * @throws Throwable
         */
        public static function parse($date, string $format = null): self
        {
            return FinancialCalendar::fromStatic('parse', $date, $format);
        }

        /**
         * Retrieve the period of the financial year for the given date
         * @param string|int|Carbon|DateTime $date The date to parse
         * @param string $format The format of the date
         * @return int
         * @throws Throwable
         */
        public static function period($date, string $format = null): int
        {
            return FinancialCalendar::fromStatic('period', $date, $format);
        }

        /**
         * Retrieve the quarter of the financial year for the given date
         * @param string|int|Carbon|DateTime $date The date to parse
         * @param string $format The format of the date
         * @return int
         * @throws Throwable
         */
        public static function quarter($date, string $format = null): int
        {
            return FinancialCalendar::fromStatic('quarter', $date, $format);
        }

        /**
         * Retrieve the week of the financial period for the given date
         * @param string|int|Carbon|DateTime $date The date to parse
         * @param string $format The format of the date
         * @return int
         * @throws Throwable
         */
        public static function weekInPeriod($date, string $format = null): int
        {
            return FinancialCalendar::fromStatic('weekInPeriod', $date, $format);
        }

        /**
         * Retrieve the week of the financial year for the given date
         * @param string|int|Carbon|DateTime $date The date to parse
         * @param string $format The format of the date
         * @return int
         * @throws Throwable
         */
        public static function weekInYear($date, string $format = null): int
        {
            return FinancialCalendar::fromStatic('weekInYear', $date, $format);
        }

        /**
         * Retrieve the financial year for the given date
         * @param string|int|Carbon|DateTime $date The date to parse
         * @param string $format The format of the date
         * @return int
         * @throws Throwable
         */
        public static function year($date, string $format = null): int
        {
            return FinancialCalendar::fromStatic('year', $date, $format);
        }
        
        /**
         * Retrieve the date a given financial year starts on
         * @param int $year
         * @return Carbon
         */
        public static function startDateForYear(int $year): Carbon
        {
            $calendar = new FinancialCalendar();
    
            return $calendar->getYearStart($year);
        }
    
        /**
         * Retrieve the date a given financial year ends on
         * @param int $year
         * @return Carbon
         */
        public static function endDateForYear(int $year): Carbon
        {
            $calendar = new FinancialCalendar();
    
            return $calendar->getYearEnd($year);
        }
    
        /**
         * Retrieve the date a given financial period starts on
         * @param int $year
         * @param int $period
         * @return Carbon
         * @throws Throwable
         */
        public static function startDateForPeriod(int $year, int $period): Carbon
        {
            $calendar = new FinancialCalendar();
    
            return $calendar->getPeriodStart($year, $period);
        }

        /**
         * Retrieve the date a given financial period ends on
         * @param int $year
         * @param int $period
         * @return Carbon
         * @throws Throwable
         */
        public static function endDateForPeriod(int $year, int $period): Carbon
        {
            $calendar = new FinancialCalendar();
    
            return $calendar->getPeriodEnd($year, $period);
        }

        /**
         * Get the financial calendar information for the current date
         * @return self
         * @throws Throwable
         */
        public static function now(): self
        {
            return new FinancialCalendar(Carbon::now());
        }
        
    // Getters
        /**
         * Retrieves the requested property
         * @param string $key The property to retrieve
         * @return int|Carbon The requested property value
         * @throws Throwable
         *
         * @property-read Carbon date A copy of the current working calendar
         * @property-read int period The calculated financial period
         * @property-read int quarter The calculated financial quarter
         * @property-read int shortWeekLimit The current short week limit
         * @property-read int weekInPeriod The calculated financial week in period
         * @property-read int weekInYear The calculated financial week in year
         * @property-read int year The calculated financial year
         */
        public function __get(string $key)
        {
            switch ($key)
            {
                case 'date':
                    return $this->getDate();
                
                case 'p':
                case 'period':
                    return $this->period;
    
                case 'q':
                case 'quarter':
                    return $this->quarter;
    
                case 'shortWeekLimit':
                    return $this->shortWeekLimit;
    
                case 'wip':
                case 'weekInPeriod':
                case 'week_in_period':
                    return $this->weekInPeriod;
    
                case 'wiy':
                case 'weekInYear':
                case 'week_in_year':
                    return $this->weekInYear;
    
                case 'y':
                case 'year':
                    return $this->year;
    
                default:
                    throw new ErrorException("$key is not an accessible property");
            }
        }
    
        /** 
         * @return array An array of the calculated financial calendar
         */
        public function asArray(): array
        {
            return [
                'year'           => $this->year,
                'week_in_year'   => $this->weekInYear,
                'quarter'        => $this->quarter,
                'period'         => $this->period,
                'week_in_period' => $this->weekInPeriod
            ];
        }
        
        /** 
         * @return object An object of the calculated financial calendar
         */
        public function asObject(): Object
        {
            return (object) $this->asArray();
        }
        
        /**
         * @return int The last working day of the week as an integer (Saturday = 6)
         */
        public function getWeekEnd(): int
        {
            return $this->calendar->getWeekEndsAt();
        }

        /**
         * @return Carbon A copy of the current calendar
         */
        public function getDate(): Carbon
        {
            return $this->calendar->copy();
        }
        
        /**
         * Get the date a financial year starts on
         * @param int $year A financial year
         * @return Carbon
         */
        public function getYearStart(int $year): Carbon
        {
            if (isset($this->yearStartOverrides[$year]) === true) {
                $yearStart = $this->yearStartOverrides[$year];
            } else {
                $yearStart = $this->yearStart;
            }
    
            return Carbon::create($year, $yearStart[0], $yearStart[1]);
        }
    
        /**
         * Get the date a financial year ends on
         * @param int $year A financial year
         * @return Carbon
         */
        public function getYearEnd(int $year): Carbon
        {
            return $this->getYearStart($year + 1)->subDay();
        }

        /**
         * Get the date a financial period starts on
         * @param int $year
         * @param int $period
         * @return Carbon
         * @throws Throwable
         */
        public function getPeriodStart(int $year, int $period): Carbon
        {
            $calendar = FinancialCalendar::parse(self::getYearStart($year));
            
            while ($calendar->period !== $period) {
                $calendar->nextPeriod();
            }
            
            return $calendar->date;
        }

        /**
         * Get the date a financial period ends on
         * @param int $year
         * @param int $period
         * @return Carbon
         * @throws Throwable
         */
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
        /**
         * Set the week length overrides
         * @param array $overrides An array of week length overrides in [year => [week => length]] format 
         * @return self
         */
        public function setWeekLengthOverrides(array $overrides): self
        {
            $this->weekLengthOverrides = $overrides;
            return $this;
        }

        /**
         * Set the year start overrides
         * @param array $overrides As array of year start dates in [year => [month, day]] format
         * @return self
         */
        public function setYearStartOverrides(array $overrides): self
        {
            $this->yearStartOverrides = $overrides;
            return $this;
        }
        
        /**
         * Set the default year start date
         * @param int $month The month the financial year ends
         * @param int $day The day of the month the financial year ends
         * @return self
         */
        public function setYearStart(int $month, int $day): self
        {
            $this->yearStart = [$month, $day];
            return $this;
        }
        
        /**
         * Set the last day of the working week
         * @param int $day An integer or Carbon constant for the day of the week (Saturday = 6)
         * @return self
         */
        public function setWeekEnd(int $day): self
        {
            $this->dayWeekEnds = $day;
            
            $this->dayWeekStarts = $day + 1 <= Carbon::SATURDAY
                ? $day + 1
                : Carbon::SUNDAY;
            
            return $this;
        }

        /**
         * Set the date to be calculated
         * @param string|int|Carbon|DateTime $date The date to be parsed
         * @param string|null $format The format of the date to be parsed
         * @return self
         */
        public function setDate($date, string $format = null): self
        {
            if (is_a($date, 'Carbon\Carbon') === true) {
                $date = $date->timestamp;

            } else if (is_a($date, 'DateTime') === true) {
                $date = $date->getTimestamp();
                
            } else if (is_string($date) === true) {
                if ($format !== null) {
                    $date = Carbon::createFromFormat($format, $date)
                        -> getTimestamp();

                } else {
                    $date = Carbon::parse($date)
                        -> getTimestamp();
                }
            }
            
            $this->calendar->timestamp($date);
            $this->calculate();
            
            return $this;
        }

        /**
         * Set how short the first week of a financial week can be
         * @param int $limit
         * @return $this
         */
        public function setShortWeekLimit(int $limit): self
        {
            $this->shortWeekLimit = $limit;
            return $this;
        }
        
    // Utility
        /**
         * Recalculate the financial calendar with the existing values
         * @return self
         */
        public function recalculate(): self
        {
            $this->calculate();
            return $this;
        }

        /**
         * Calculates the number of days until the next financial week
         * @param Carbon $date
         * @return int
         */
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
        
        /**
         * Moves the calendar forward to the next period in the year
         * @return self
         */
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

        /**
         * Moves the calendar forward to the next week in the year
         * @return self
         */
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

        /**
         * Calculates the modulus of value % dividend with arithmetic correction
         * @param integer $value The number to be divided
         * @param integer $dividend The amount to divide by
         * @return integer The remainder after modulo operation
         */
        protected function modulo($value, $dividend)
        {
            $output = $value % $dividend;
    
            if ($output < 0) {
                return $output + $dividend;
            }
    
            return $output;
        }
        
    // Calculation
        /** 
         * Calculates the financial calendar for the set date
         */
        protected function calculate()
        {
            $this->year         = $this->calculateYear();
            $this->weekInYear   = $this->calculateWeekInYear($this->year);
            $this->period       = $this->calculatePeriod($this->weekInYear);
            $this->weekInPeriod = $this->calculateWeekInPeriod($this->weekInYear);
            $this->quarter      = $this->calculateQuarter($this->period);
        }

        /**
         * Calculates the financial year taking into account any manual year-start overrides
         * @return int The financial year
         */
        protected function calculateYear(): int
        {
            $yearStart = $this->getYearStart($this->calendar->year);
            
            if ($this->calendar->isBefore($yearStart)) {
                return $this->calendar->year - 1;
            }

            return $this->calendar->year;
        }

        /**
         * Calculates the week of the financial year taking into account any manual week-length overrides
         * @param int $year A financial year
         * @return int The week of the financial year
         */
        protected function calculateWeekInYear(int $year): int
        {
            $week        = 1;
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

        /**
         * Calculate the quarter for the given financial period
         * @param int $period A period in the financial year
         * @return int The financial quarter
         */
        protected function calculateQuarter(int $period): int
        {
            $quarter = ceil($period / 3);
            
            if ($quarter > 4) {
                return 4;
            }
            
            return $quarter;
        }

        /**
         * Calculate the period for a given week in a financial year
         * @param int $weekInYear A week in the financial year
         * @return int The period of the financial year
         */
        protected function calculatePeriod(int $weekInYear): int
        {
            return ceil($weekInYear * 0.25);
        }

        /**
         * Calculate the week for a given financial period
         * @param int $weekInYear A week in the financial year
         * @return int The week of the financial period
         */
        protected function calculateWeekInPeriod(int $weekInYear): int
        {
            $week = $this->modulo($weekInYear, 4);
            
            if ($week === 0) {
                return 4;
            }
            
            return $week;
        }
}
