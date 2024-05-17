<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Providers;

use Illuminate\Support\ServiceProvider;
use NetworkRailBusinessSystems\FinancialCalendar\Facades\FinancialCalendarFacade;
use NetworkRailBusinessSystems\FinancialCalendar\FinancialCalendar;

class FinancialCalendarServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->app->singleton('FinancialCalendar', function () {
            return new FinancialCalendar;
        });

        $this->app->alias('FinancialCalendar', FinancialCalendarFacade::class);
    }
}
