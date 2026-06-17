<?php

namespace App\Filament\Resources\CalculatorSettings\Pages;

use App\Filament\Resources\CalculatorSettings\CalculatorSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCalculatorSettings extends ListRecords
{
    protected static string $resource = CalculatorSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
