<?php

namespace App\Filament\Blocks\RichContentBlocks;
use App\Filament\Blocks\BaseBlock;
use Filament\Forms;
use Filament\Forms\Form;

class StatsSection extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\TextInput::make('title'),
            Forms\Components\RichEditor::make('subtitle'),
            Forms\Components\Repeater::make('statistics')->schema([
                Forms\Components\TextInput::make('label'),
                Forms\Components\TextInput::make('quantity'),
            ])->cloneable(),
        ];
    }
}
