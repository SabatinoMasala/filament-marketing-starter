<?php

namespace App\Filament\Blocks;

class RichContent extends BaseGroup
{
    static function getLoaderConfiguration()
    {
        return [
            'dir' => __DIR__ . '/RichContentBlocks',
            'fqn' => '\\App\\Filament\\Blocks\\RichContentBlocks\\',
        ];
    }
}
