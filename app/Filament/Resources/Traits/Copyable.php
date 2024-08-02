<?php

namespace App\Filament\Resources\Traits;

use Filament\Actions;
use Filament\Forms\Components\Select;

trait Copyable {
    protected function getCopyAction($fieldsToCopy = [])
    {
        return Actions\Action::make('copyFromLocale')
            ->form([
                Select::make('locale')->options([
                    'nl' => 'Dutch',
                    'en' => 'English',
                    'fr' => 'French',
                ])
                    ->default('nl')
                    ->required(),
            ])
            ->action(function (array $data) use ($fieldsToCopy) {
                $propsToCopy = $fieldsToCopy;
                collect($propsToCopy)->each(function($prop) use ($data) {
                    $dataToCopy = $this->record->getTranslations()[$prop][$data['locale']];
                    $this->record->setTranslation($prop, $this->activeLocale, $dataToCopy);
                });
                $this->record->save();
            })
            ->after(fn ($livewire) => $this->fillForm())
            ->link();
    }
}
