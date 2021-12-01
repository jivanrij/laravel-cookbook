<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Post extends Resource
{

    public static $model = \App\Models\Post::class;

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
            BelongsToMany::make('Categories'),
            // is the same as
            // BelongsToMany::make('Categories', 'categories', Category::class),
            // with the last one you can specify the table & FK field
            // in case you don't work with Laravel naming conventions.
            // Make sure the 3rd parameter is the Resource, not the Model.

            BelongsTo::make('User'),

            // This
            HasMany::make('Comments'),
            // is the same as
            // HasMany::make('Comments', 'comments', Comment::class),
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
