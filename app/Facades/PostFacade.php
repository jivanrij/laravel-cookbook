<?php

namespace App\Facades;

use App\Services\PostService;
use Illuminate\Support\Facades\Facade;

class PostFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PostService::class;
    }
}
