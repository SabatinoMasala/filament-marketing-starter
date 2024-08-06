<?php

namespace App\Filament\Blocks\RichContentBlocks;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;

class HeroSection extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\Select::make('background')->options([
                'black' => 'Black',
                'primary' => 'Primary',
                'white' => 'White',
            ]),
            FileUpload::make('hero_image')->image(),
            Forms\Components\TextInput::make('hero_title'),
            Forms\Components\RichEditor::make('hero_subtitle'),
            Forms\Components\Repeater::make('buttons')->schema([
                Forms\Components\TextInput::make('label'),
                Forms\Components\TextInput::make('url'),
                Forms\Components\TextInput::make('variant'),
            ]),
        ];
    }
}
