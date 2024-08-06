<?php

namespace App\Filament\BlockGroups;

class RichContent extends BaseGroup
{
    static function getLoaderConfiguration()
    {
        return [
            'dir' => dirname(__DIR__) . '/Blocks/RichContentBlocks',
            'fqn' => '\\App\\Filament\\Blocks\\RichContentBlocks\\',
        ];
    }
}
