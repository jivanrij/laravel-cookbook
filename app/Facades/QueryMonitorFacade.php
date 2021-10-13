<?php

namespace App\Facades;

use App\Services\QueryMonitorService;
use Illuminate\Support\Facades\Facade;

class QueryMonitorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return QueryMonitorService::class;
    }
}
