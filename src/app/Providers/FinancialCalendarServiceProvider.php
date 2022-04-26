<?php

namespace NRBusinessSystems\FinancialCalendar\Providers;

use NRBusinessSystems\FinancialCalendar\Facades\FinancialCalendarFacade;
use NRBusinessSystems\FinancialCalendar\FinancialCalendar;
use Illuminate\Support\ServiceProvider;

class FinancialCalendarServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->app->singleton('FinancialCalendar', function()
        {
            return new FinancialCalendar;
        });

        $this->app->alias('FinancialCalendar', FinancialCalendarFacade::class);
    }
}
