<?php

namespace App\Filament\Resources\Blocks;

use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Str;

class Properties
{
    public static function make(Form $form, $fields = ['title', 'slug', 'seo'])
    {
        $schema = [
            TextInput::make('title')
                ->afterStateUpdated(function ($get, $set, ?string $state) {
                    if (! $get('meta.is_slug_changed_manually') && filled($state)) {
                        $set('slug', Str::slug($state));
                    }
                    if (! $get('is_seo_title_changed_manually') && filled($state)) {
                        $set('seo.title', $state);
                    }
                })
                ->reactive()
                ->live(onBlur: false, debounce: 500)
                ->required(),
            TextInput::make('slug')
                ->afterStateUpdated(function ($set) {
                    $set('meta.is_slug_changed_manually', true);
                })
                ->reactive()
                ->required(),
            Hidden::make('meta.is_slug_changed_manually'),
            Hidden::make('meta.is_seo_title_changed_manually'),
        ];
        if (in_array('published_at', $fields)) {
            $schema[] = DateTimePicker::make('published_at');
        }
        if (in_array('featured_image', $fields)) {
            $schema[] = FileUpload::make('featured_image')->image();
        }
        if (in_array('short_description', $fields)) {
            $schema[] = TextArea::make('short_description')->required()->columnSpanFull();
        }
        if (in_array('seo', $fields)) {
            $schema[] = Section::make('SEO')
                ->schema([
                    Forms\Components\TextInput::make('seo.title')
                        ->afterStateUpdated(function ($set) {
                            $set('meta.is_seo_title_changed_manually', true);
                        })
                        ->reactive(),
                    Forms\Components\Textarea::make('seo.description'),
                    FileUpload::make('seo.image')->image(),
                ])
                ->collapsed();
        }
        return [
            Section::make('Properties')
                ->schema($schema)
                ->columns(2)
        ];
    }
}
