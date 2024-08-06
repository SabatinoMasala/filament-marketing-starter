<?php

namespace App\Filament\Blocks\RichContentBlocks;
use App\Filament\Blocks\BaseBlock;
use Filament\Forms;
use Filament\Forms\Form;

class PricingSection extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\TextInput::make('title_monthly'),
            Forms\Components\TextInput::make('title_yearly'),
            Forms\Components\Repeater::make('columns')->schema([
                Forms\Components\TextInput::make('title'),
                Forms\Components\Checkbox::make('most_popular'),
                Forms\Components\TextInput::make('button_title'),
                Forms\Components\TextInput::make('button_link'),
                Forms\Components\TextInput::make('price_monthly')->numeric(),
                Forms\Components\TextInput::make('price_yearly')->numeric(),
            ])->cloneable(),
            Forms\Components\Repeater::make('features')->schema([
                Forms\Components\TextInput::make('title'),
                Forms\Components\RichEditor::make('more_info'),
                Forms\Components\Textarea::make('tiers')->helperText('Separate each tier with a comma.'),
            ])->cloneable()
        ];
    }
}
