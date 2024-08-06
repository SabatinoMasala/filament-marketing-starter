<?php

namespace App\Filament\Blocks\RichContentBlocks;
use Filament\Forms;
use Filament\Forms\Form;

class ModulesSection extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\TextInput::make('per_page')->numeric()->default(9),
        ];
    }
}
