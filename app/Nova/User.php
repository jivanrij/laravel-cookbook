<?php

namespace App\Nova;

use App\Nova\Actions\FlowAction;
use App\Nova\Actions\LayoutAction;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

class User extends Resource
{
    public static $model = \App\Models\User::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'email',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            // This
            HasMany::make('Posts'),
            // is the same as
            // HasMany::make('Posts', 'posts', Post::class),
            // with the last one you can specify the table & FK field
            // in case you don't work with Laravel naming conventions.
            // Make sure the 3rd parameter is the Resource, not the Model.

            // Because I like to camelCase my relations, I need to supply the relation method on the model.
            // If you don't do this, Laravel will look for a method called personal_info.
            HasOne::make('Personal Info', 'personalInfo'),
            // You can also provide the resource, just like the HasMany.
            // HasOne::make('Personal Info', 'personalInfo', PersonalInfo::class),
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
        return [
            new FlowAction,
            new LayoutAction
        ];
    }
}
