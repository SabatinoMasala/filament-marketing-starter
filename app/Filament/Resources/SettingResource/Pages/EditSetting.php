<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\Traits\Copyable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Spatie\ResponseCache\Facades\ResponseCache;

class EditSetting extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    use Copyable;

    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getCopyAction(['value']),
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function afterSave()
    {
        ResponseCache::clear();
    }

}
