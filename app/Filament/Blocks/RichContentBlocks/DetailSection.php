<?php

namespace App\Filament\Blocks\RichContentBlocks;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;

class DetailSection extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\TextInput::make('title'),
            Forms\Components\TextInput::make('supertitle'),
            FileUpload::make('image')->image(),
            Forms\Components\Select::make('image_position')->options([
                'left' => 'Left',
                'right' => 'Right',
            ]),
            Forms\Components\RichEditor::make('description'),
            Forms\Components\Repeater::make('features')->schema([
                Forms\Components\TextInput::make('title'),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('button_text'),
                Forms\Components\TextInput::make('button_link'),
            ])
                ->collapsed()
                ->collapsible()
                ->cloneable(),
            Forms\Components\TextInput::make('cta_button_text'),
            Forms\Components\TextInput::make('cta_link'),
        ];
    }
}
