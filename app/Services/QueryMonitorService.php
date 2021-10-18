<?php

namespace App\Services;

use App\Facades\QueryMonitorFacade;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class QueryMonitorService
{
    private $queryData = [];

    private $active = false;

    public function __constructor()
    {
        $this->queryData['unique_queries_different_parameters'] = [];
        $this->queryData['unique_queries_unique_parameters'] = [];
    }

    public function getQueryData()
    {
        return $this->queryData;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function startListening()
    {
        $this->active = true;
    }

    public function stopListening()
    {
        $this->active = false;
    }

    public function logResults()
    {

//        $this->queryData[$key]['totalTime'] = $totalTime;
//        $this->queryData[$key]['sql'] = $executedQuery->sql;
//        $this->queryData[$key]['count'] = $count;
//        $this->queryData[$key]['avgTime'] = $avgTime;

        Log::info(' !!! Queries grouped by unique structure and executed more then once. !!! ');

        $totalQueries = 0;
        foreach (Arr::get($this->queryData, 'unique_queries_different_parameters', []) as $key => $query) {
            $totalQueries = $totalQueries + $query['timesExecuted'];
            if ($query['timesExecuted'] > 1) {
                Log::info('table: ' . $query['table'] . ' executed ' . $query['timesExecuted'] . ' times, total time: ' . $query['totalTime'] . ' avg time per execution: ' . $query['avgTime'] . ' query: ' . $query['sql']);
            }
        }


        Log::info(' !!! Queries grouped by unique structure & parameters and executed more then once. !!! ');
        $totalQueries = 0;
        foreach (Arr::get($this->queryData, 'unique_queries_unique_parameters', []) as $key => $query) {
            $totalQueries = $totalQueries + $query['timesExecuted'];
            if ($query['timesExecuted'] > 1) {
                Log::info('table: ' . $query['table'] . ' executed ' . $query['timesExecuted'] . ' times, total time: ' . $query['totalTime'] . ' avg time per execution: ' . $query['avgTime'] . ' query: ' . $query['sql'] . ' query: ' . $query['bindings']);
            }
        }
        Log::info(' !!! Total there where ' . $totalQueries . ' queries executed on url ' . request()->url());

        Log::info('==============================================================================');
    }

    public function injectListener()
    {
        DB::listen(function($executedQuery) {
            if (QueryMonitorFacade::isActive()) {
                $this->rememberQuery($executedQuery, 'unique_queries_different_parameters', hash('md5',$executedQuery->sql . $executedQuery->connection->getName()));
                $this->rememberQuery($executedQuery, 'unique_queries_unique_parameters', hash('md5',$executedQuery->sql . serialize($executedQuery->bindings) . $executedQuery->connection->getName()));
            }
        });
    }

    public function rememberQuery(\Illuminate\Database\Events\QueryExecuted $executedQuery, $category, $key)
    {
        $totalTime = Arr::get($this->queryData, $category . '.' . $key . '.totalTime', (float) 0);
        $count = Arr::get($this->queryData, $category . '.' . $key . '.timesExecuted', 0);

        $totalTime = $totalTime + $executedQuery->time;
        $count++;

        if ($count === 0) {
            $avgTime = $totalTime;
        } else {
            $avgTime = $totalTime / $count;
        }
        $this->queryData[$category][$key]['table'] = Str::before(Str::after($executedQuery->sql, 'from `'), '`');
//                $this->queryData[$key]['executedQueries'] = $executedQueries;
        $this->queryData[$category][$key]['totalTime'] = $totalTime;
        $this->queryData[$category][$key]['sql'] = Str::limit($executedQuery->sql, 50);
        $this->queryData[$category][$key]['sql'] = $executedQuery->sql;
        $this->queryData[$category][$key]['timesExecuted'] = $count;
        $this->queryData[$category][$key]['avgTime'] = $avgTime;
        $this->queryData[$category][$key]['bindings'] = serialize($executedQuery->bindings);
    }
}
