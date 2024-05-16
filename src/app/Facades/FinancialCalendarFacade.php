<?php

namespace NetworkRailBusinessSystems\FinancialCalendar\Facades;

use Illuminate\Support\Facades\Facade;

class FinancialCalendarFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'FinancialCalendar';
    }
}
