<?php

namespace App\Filament\Blocks\RichContentBlocks;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class TestimonialSection extends BaseBlock
{
    static function schema(Form $form)
    {
        return [
            Forms\Components\TextInput::make('review_section_header'),
            Forms\Components\TextInput::make('review_section_subheader'),
            Forms\Components\Repeater::make('testimonials')->schema([
                Forms\Components\TextInput::make('rating')->numeric()->minValue(0)->maxValue(5)->step(1),
                Forms\Components\RichEditor::make('review'),
                FileUpload::make('picture')->image(),
                TextInput::make('name'),
            ])
                ->collapsed()
                ->cloneable()
                ->collapsible(),
        ];
    }
}
