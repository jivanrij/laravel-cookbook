<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Flexible;

class LayoutAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
    }

    public function fields()
    {
        return [
            Flexible::make('Content')
                ->addLayout('Simple content section', 'wysiwyg', [
                    Text::make('Title'),
                    Markdown::make('Content')
                ])
                ->addLayout('Video section', 'video', [
                    Text::make('Title'),
                    Image::make('Video Thumbnail', 'thumbnail'),
                    Text::make('Video ID (YouTube)', 'video'),
                    Text::make('Video Caption', 'caption')
                ])
        ];
    }
}
