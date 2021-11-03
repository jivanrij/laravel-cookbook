<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, string $terms = null)
    {
        User::search(explode(' ', $terms))->get();

        return view('laravel');
    }
}
