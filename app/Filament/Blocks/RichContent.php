<?php

namespace App\Filament\Blocks;

use App\Filament\Blocks\RichContentBlocks\BlogSection;
use App\Filament\Blocks\RichContentBlocks\DetailSection;
use App\Filament\Blocks\RichContentBlocks\FaqSection;
use App\Filament\Blocks\RichContentBlocks\FeaturelistSection;
use App\Filament\Blocks\RichContentBlocks\HeroSection;
use App\Filament\Blocks\RichContentBlocks\Image;
use App\Filament\Blocks\RichContentBlocks\LogoSection;
use App\Filament\Blocks\RichContentBlocks\ModulesSection;
use App\Filament\Blocks\RichContentBlocks\PricingSection;
use App\Filament\Blocks\RichContentBlocks\RichEditor;
use App\Filament\Blocks\RichContentBlocks\StatsSection;
use App\Filament\Blocks\RichContentBlocks\TestimonialSection;
use App\Filament\Blocks\RichContentBlocks\TitleSection;
use Filament\Forms\Components\Builder;
use Filament\Forms\Form;

class RichContent
{
    public static function builder(Form $form, $name = 'content'): Builder
    {
        return Builder::make($name)
            ->blocks([
                RichEditor::make($form),
                DetailSection::make($form),
                HeroSection::make($form),
                FeaturelistSection::make($form),
                BlogSection::make($form),
                ModulesSection::make($form),
                PricingSection::make($form),
                TestimonialSection::make($form),
                HeroSection::make($form),
                FaqSection::make($form),
                LogoSection::make($form),
                StatsSection::make($form),
                TitleSection::make($form),
                Image::make($form),
            ])
                ->collapsible()
                ->cloneable();
    }
}
