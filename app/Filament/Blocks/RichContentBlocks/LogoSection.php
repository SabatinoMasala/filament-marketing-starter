<?php

namespace App\Filament\Blocks\RichContentBlocks;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;

class LogoSection extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\TextInput::make('title')->default('Our Partners'),
            Forms\Components\Select::make('background')->options([
                'default' => 'Default',
                'white' => 'White',
            ])->default('default'),
            Forms\Components\Repeater::make('logos')->schema([
                Forms\Components\TextInput::make('title'),
                FileUpload::make('url')
                    ->image()
                    ->required(),
            ]),
        ];
    }
}
