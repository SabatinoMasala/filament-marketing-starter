<?php

namespace App\Filament\Blocks\RichContentBlocks;

use Filament\Forms\Components\Builder;
use Filament\Forms\Form;

class BaseBlock
{
    static function getName()
    {
        return \Str::snake((new \ReflectionClass(static::class))->getShortName());
    }

    static function make(Form $form)
    {
        return Builder\Block::make(static::getName())
            ->schema(static::schema($form));
    }

    static function schema(Form $form)
    {
        return [];
    }

}
