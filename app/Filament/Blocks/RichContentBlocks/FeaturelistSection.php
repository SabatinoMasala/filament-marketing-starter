<?php

namespace App\Filament\Blocks\RichContentBlocks;
use App\Filament\Blocks\BaseBlock;
use Filament\Forms;
use Filament\Forms\Form;

class FeaturelistSection extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\TextInput::make('title'),
            Forms\Components\TextInput::make('subtitle'),
            Forms\Components\RichEditor::make('content'),
            Forms\Components\Repeater::make('features')->schema([
                Forms\Components\TextInput::make('title'),
                Forms\Components\RichEditor::make('description'),
            ])
                ->collapsed()
                ->collapsible()
                ->cloneable(),
        ];
    }
}
