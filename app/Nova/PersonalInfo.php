<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class PersonalInfo extends Resource
{

    public static $model = \App\Models\PersonalInfo::class;


    public static $title = 'title';


    public static $search = [
        'title',
    ];


    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')
                ->sortable(),

            Text::make('Title'),
            Text::make('Hobby'),
            Text::make('Nickname'),

            BelongsTo::make('User')
        ];
    }


    public function cards(Request $request)
    {
        return [];
    }


    public function filters(Request $request)
    {
        return [];
    }


    public function lenses(Request $request)
    {
        return [];
    }


    public function actions(Request $request)
    {
        return [];
    }
}
