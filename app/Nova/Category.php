<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Category extends Resource
{

    public static $model = \App\Models\Category::class;

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

            // This
            BelongsToMany::make('Posts'),
            // is the same as
            // BelongsToMany::make('Posts', 'posts', Post::class),
            // with the last one you can specify the table & FK field
            // in case you don't work with Laravel naming conventions.
            // Make sure the 3rd parameter is the Resource, not the Model.
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
