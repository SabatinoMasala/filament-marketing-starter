<?php

namespace App\Filament\Blocks\RichContentBlocks;
use Filament\Forms;
use Filament\Forms\Form;

class RichEditor extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\RichEditor::make('content')->toolbarButtons([
                'attachFiles',
                'blockquote',
                'bold',
                'bulletList',
                'codeBlock',
                'h1',
                'h2',
                'h3',
                'italic',
                'link',
                'orderedList',
                'redo',
                'strike',
                'underline',
                'undo',
            ]),
        ];
    }
}
