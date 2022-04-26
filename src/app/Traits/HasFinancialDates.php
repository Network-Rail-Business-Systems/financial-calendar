<?php

namespace NRBusinessSystems\FinancialCalendar\Traits;

use Illuminate\Database\Eloquent\Builder;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;

/**
 * Add query scopes to Eloquent models where the year and period are not already stored
 * @package NRBusinessSystems\FinancialCalendar\Traits
 */
trait HasFinancialDates
{
    abstract protected function financialDateColumn(): string;
    
    public function scopeForFinancialYear(Builder $query, int $year): Builder
    {
        return $query->whereBetween(
            $this->financialDateColumn(),
            [
                FinancialCalendar::startDateForYear($year),
                FinancialCalendar::endDateForYear($year)
            ]
        );
    }
    
    public function scopeForFinancialPeriod(Builder $query, int $year, int $period): Builder
    {
        return $query->whereBetween(
            $this->financialDateColumn(),
            [
                FinancialCalendar::startDateForPeriod($year, $period),
                FinancialCalendar::endDateForPeriod($year, $period)
            ]
        );
    }
}
