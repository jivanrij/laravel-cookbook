<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, string $terms = null)
    {
        ray()->showQueries();

        // This is "foo bar"
        // will result in the following terms array:
        // ['This', 'is', 'foo bar']
        $terms = str_getcsv($terms, ' ', '"');
        $data = PersonalInfo::search($terms)->get();

        ray()->stopShowingQueries();

//        return $data;

        return view('laravel');
    }
}
