<?php
namespace NRBusinessSystems\FinancialCalendar\Facades;

use Illuminate\Support\Facades\Facade;

class FinancialCalendarFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'FinancialCalendar';
    }
}