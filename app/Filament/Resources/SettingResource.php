<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    use Translatable;
    protected static ?string $model = Setting::class;
    protected static ?string $recordTitleAttribute = 'key';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('key')->required(),
                TextInput::make('group')->required(),
                Builder::make('value')
                    ->blocks([
                        Builder\Block::make('string')
                            ->schema([
                                TextInput::make('value'),
                            ]),
                        Builder\Block::make('rich_editor')
                            ->schema([
                                RichEditor::make('value'),
                            ]),
                        Builder\Block::make('navlink')
                            ->schema([
                                Repeater::make('value')->schema([
                                    TextInput::make('name'),
                                    Textarea::make('link'),
                                ])
                                    ->collapsed()
                                    ->collapsible()
                                    ->cloneable(),
                            ]),
                        Builder\Block::make('footer')
                            ->schema([
                                Repeater::make('value')->schema([
                                    TextInput::make('title'),
                                    Repeater::make('links')->schema([
                                        TextInput::make('name'),
                                        Textarea::make('link'),
                                    ])
                                        ->collapsed()
                                        ->collapsible()
                                        ->cloneable(),
                                ])
                                    ->collapsed()
                                    ->collapsible()
                                    ->cloneable(),
                            ]),
                    ])
                    ->collapsible()
                    ->maxItems(1)
                    ->reorderable(false)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->searchable(),
                TextColumn::make('group')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
