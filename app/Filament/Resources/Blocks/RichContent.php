<?php

namespace App\Filament\Resources\Blocks;

use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class RichContent
{
    public static function builder(Form $form, $name = 'content'): Builder
    {
        return Builder::make($name)
            ->blocks([
                Builder\Block::make('rich_editor')
                    ->schema([
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
                    ]),
                Builder\Block::make('detail_section')
                    ->schema([
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\TextInput::make('supertitle'),
                        FileUpload::make('image')->image(),
                        Forms\Components\Select::make('image_position')->options([
                            'left' => 'Left',
                            'right' => 'Right',
                        ]),
                        Forms\Components\RichEditor::make('description'),
                        Forms\Components\Repeater::make('features')->schema([
                            Forms\Components\TextInput::make('title'),
                            Forms\Components\Textarea::make('description'),
                            Forms\Components\TextInput::make('button_text'),
                            Forms\Components\TextInput::make('button_link'),
                        ])
                            ->collapsed()
                            ->collapsible()
                            ->cloneable(),
                        Forms\Components\TextInput::make('cta_button_text'),
                        Forms\Components\TextInput::make('cta_link'),
                    ]),
                Builder\Block::make('hero_section')
                    ->schema([
                        Forms\Components\Select::make('background')->options([
                            'black' => 'Black',
                            'primary' => 'Primary',
                        ]),
                        FileUpload::make('hero_image')->image(),
                        Forms\Components\TextInput::make('hero_title'),
                        Forms\Components\RichEditor::make('hero_content'),
                        Forms\Components\Repeater::make('buttons')->schema([
                            Forms\Components\TextInput::make('label'),
                            Forms\Components\TextInput::make('url'),
                            Forms\Components\Select::make('variant')->options([
                                'red' => 'Red',
                                'transparent' => 'Transparent',
                            ]),
                        ])
                            ->collapsed()
                            ->collapsible()
                            ->cloneable(),
                    ]),
                Builder\Block::make('featurelist_section')
                    ->schema([
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
                    ]),
                Builder\Block::make('blog_section')
                    ->schema([
                        Forms\Components\TextInput::make('per_page')->numeric()->default(9),
                    ]),
                Builder\Block::make('modules_section')
                    ->schema([
                        Forms\Components\TextInput::make('per_page')->numeric()->default(9),
                    ]),
                Builder\Block::make('pricing_section')
                    ->schema([
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
                    ]),
                Builder\Block::make('testimonial_section')
                    ->schema([
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
                    ]),
                Builder\Block::make('hero_section')
                    ->schema([
                        Forms\Components\Select::make('background')->options([
                            'black' => 'Black',
                            'primary' => 'Primary',
                            'white' => 'White',
                        ]),
                        FileUpload::make('hero_image')->image(),
                        Forms\Components\TextInput::make('hero_title'),
                        Forms\Components\RichEditor::make('hero_subtitle'),
                        Forms\Components\Repeater::make('buttons')->schema([
                            Forms\Components\TextInput::make('label'),
                            Forms\Components\TextInput::make('url'),
                            Forms\Components\TextInput::make('variant'),
                        ]),
                    ]),
                Builder\Block::make('featurelist_section')
                    ->schema([
                        Forms\Components\TextInput::make('features_header'),
                        Forms\Components\TextInput::make('features_alt_header'),
                        Forms\Components\RichEditor::make('features_subheader'),
                        Forms\Components\Repeater::make('features')->schema([
                            Forms\Components\TextInput::make('feature_title'),
                            Forms\Components\RichEditor::make('feature_description'),
                            Forms\Components\TextInput::make('button_text'),
                            Forms\Components\TextInput::make('button_link'),
                        ]),
                    ]),
                Builder\Block::make('faq_section')
                    ->schema([
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\RichEditor::make('subtitle'),
                        Forms\Components\Repeater::make('questions')->schema([
                            Forms\Components\TextInput::make('question'),
                            Forms\Components\RichEditor::make('answer'),
                        ]),
                    ]),
                Builder\Block::make('logo_section')
                    ->schema([
                        Forms\Components\TextInput::make('title')->default('Our Partners'),
                        Forms\Components\Select::make('background')->options([
                            'default' => 'Default',
                            'white' => 'White',
                        ])->default('default'),
                        Forms\Components\Repeater::make('logos')->schema([
                            Forms\Components\TextInput::make('title'),
                            FileUpload::make('url')
                                ->image()
                                ->required(),
                        ]),
                    ]),
                Builder\Block::make('stats_section')
                    ->schema([
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\RichEditor::make('subtitle'),
                        Forms\Components\Repeater::make('statistics')->schema([
                            Forms\Components\TextInput::make('label'),
                            Forms\Components\TextInput::make('quantity'),
                        ])->cloneable(),
                    ]),
                Builder\Block::make('cta_demo_form')
                    ->schema([
                        Forms\Components\TextInput::make('title'),
                    ]),
                Builder\Block::make('title_section')
                    ->schema([
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\TextInput::make('subtitle'),
                        Forms\Components\Select::make('variant')->options([
                            'default' => 'Default',
                            'plain' => 'Plain',
                        ])->default('default'),
                        Forms\Components\RichEditor::make('description'),
                        Forms\Components\Repeater::make('buttons')->schema([
                            Forms\Components\TextInput::make('label'),
                            Forms\Components\TextInput::make('url'),
                            Forms\Components\Select::make('variant')->options([
                                'red' => 'Red',
                                'transparent' => 'Transparent',
                            ]),
                        ])
                            ->collapsed()
                            ->collapsible()
                            ->cloneable(),
                    ]),
                Builder\Block::make('image')
                    ->schema([
                        FileUpload::make('url')
                            ->image()
                            ->required(),
                        TextInput::make('alt')
                            ->required(),
                    ]),
            ])
                ->collapsible()
                ->cloneable();
    }
}
