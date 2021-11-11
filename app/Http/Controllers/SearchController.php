<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, string $terms = null)
    {
        // This is "foo bar"
        // will result in the following terms array:
        // ['This', 'is', 'foo bar']
        $terms = str_getcsv($terms,' ', '"');
        User::search($terms)->get();

        return view('laravel');
    }
}
