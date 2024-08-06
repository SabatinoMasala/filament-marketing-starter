<?php

namespace App\Filament\Blocks\RichContentBlocks;
use Filament\Forms;
use Filament\Forms\Form;

class FaqSection extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\TextInput::make('title'),
            Forms\Components\RichEditor::make('subtitle'),
            Forms\Components\Repeater::make('questions')->schema([
                Forms\Components\TextInput::make('question'),
                Forms\Components\RichEditor::make('answer'),
            ]),
        ];
    }
}
