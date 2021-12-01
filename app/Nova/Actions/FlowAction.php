<?php

namespace App\Nova\Actions;

use App\Rules\ValidateFalseRule;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class FlowAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
    }

    public function fields()
    {
        return [
            Select::make('Action', 'action')->options([
                0 => 'Install site for customer',
                1 => 'Install site for reseller',
            ])
                ->displayUsingLabels()
                ->required()
                ->rules(['required']),

            NovaDependencyContainer::make([
                Heading::make('Customer information'),
                Select::make('Customer', 'customer')->options([
                    0 => 'Mollis Tortor',
                    1 => 'Bibendum Ultricies',
                    2 => 'Elit Euismod',
                    3 => 'Condimentum Porta',
                    4 => 'Elit Lorem',
                    5 => 'Fusce Purus',
                    6 => 'Justo Pellentesque',
                ])->required(true)
                    ->rules(['required', new ValidateFalseRule]),

                NovaDependencyContainer::make([
                    Textarea::make('Information', 'customer')
                        ->required(true)
                        ->rules(['required', new ValidateFalseRule])
                        ->help('Can you provide some extra information? We are missing some data of customer Bibendum Ultricies.'),
                ])->dependsOn('customer', 1)->required()->rules(['required']),

                Heading::make('Site information'),
                Select::make('Moodle version', 'moodle_version')->options([
                    0 => 'LMS',
                    1 => 'MWP',
                ])->required(true)
                    ->rules(['required']),
                NovaDependencyContainer::make([
                    Number::make('Amount of MWP users', 'user_amount')
                        ->help('How many users do you expect to use the application?')->required(true)
                        ->rules(['required']),
                    Number::make('Amount of MWP users at once', 'user_amount_at_once')
                        ->help('How many users do you expect to use the application at the same time?')->required(true)
                        ->rules(['required']),
                ])->dependsOn('moodle_version', 1),

                NovaDependencyContainer::make([
                    Boolean::make('Conference call', 'conference_call')
                        ->help('I would like to be able to do conference calls.')->required(true)
                        ->rules(['required']),
                ])->dependsOn('moodle_version', 0),

            ])->dependsOn('action', 0),

            NovaDependencyContainer::make([
                Heading::make('Reseller information')
                    ->required(true)
                    ->rules(['required']),
                Text::make('Reseller', 'reseller')->required(true)
                    ->rules(['required']),
                Text::make('Reseller name', 'reseller_name')->required(true)
                    ->rules(['required']),
                Text::make('Reseller ID', 'reseller_id')
                    ->rules(['required'])->required(true)
                    ->rules(['required']),
            ])->dependsOn('action', 1),
        ];
    }

    public function name()
    {
        return 'Flow form example';
    }
}
