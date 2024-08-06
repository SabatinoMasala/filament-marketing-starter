<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder;
use Filament\Forms\Form;

class BaseGroup
{
    public static function builder(Form $form, $name = 'content'): Builder
    {
        return static::loadFromDirectory(static::getLoaderConfiguration(), $form, $name);
    }

    public static function getLoaderConfiguration()
    {
        throw new \Exception('You must implement getLoaderConfiguration() method in your class: ' . static::class);
    }

    public static function loadFromDirectory($loaderConfig, $form, $name)
    {
        $directory = rtrim($loaderConfig['dir'], '/') . '/';
        $blocks = [];
        foreach (glob($directory . '*.php') as $filename) {
            // Remove the directory from the filename
            $filename = str_replace($directory, '', $filename);
            // Transform filename to class name
            $filename = str_replace('/', '\\', $filename);
            $class = $loaderConfig['fqn'] . basename($filename, '.php');
            $blocks[] = $class::make($form);
        }
        return Builder::make($name)
            ->blocks($blocks)
            ->collapsible()
            ->cloneable();
    }
}
