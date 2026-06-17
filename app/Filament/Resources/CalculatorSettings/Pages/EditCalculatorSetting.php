<?php

namespace App\Filament\Resources\CalculatorSettings\Pages;

use App\Filament\Resources\CalculatorSettings\CalculatorSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCalculatorSetting extends EditRecord
{
    protected static string $resource = CalculatorSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
