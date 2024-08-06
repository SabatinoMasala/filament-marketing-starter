<?php

namespace App\Filament\Blocks\RichContentBlocks;
use App\Filament\Blocks\BaseBlock;
use Filament\Forms;
use Filament\Forms\Form;

class TitleSection extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\TextInput::make('title'),
            Forms\Components\TextInput::make('subtitle'),
            Forms\Components\Select::make('variant')->options([
                'default' => 'Default',
                'plain' => 'Plain',
            ])->default('default'),
            Forms\Components\RichEditor::make('description'),
            Forms\Components\Repeater::make('buttons')->schema([
                Forms\Components\TextInput::make('label'),
                Forms\Components\TextInput::make('url'),
                Forms\Components\Select::make('variant')->options([
                    'red' => 'Red',
                    'transparent' => 'Transparent',
                ]),
            ])
                ->collapsed()
                ->collapsible()
                ->cloneable(),
        ];
    }
}
