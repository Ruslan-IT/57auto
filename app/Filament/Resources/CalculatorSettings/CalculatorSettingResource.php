<?php

namespace App\Filament\Resources\CalculatorSettings;

use App\Filament\Resources\CalculatorSettings\Pages\CreateCalculatorSetting;
use App\Filament\Resources\CalculatorSettings\Pages\EditCalculatorSetting;
use App\Filament\Resources\CalculatorSettings\Pages\ListCalculatorSettings;
use App\Filament\Resources\CalculatorSettings\Schemas\CalculatorSettingForm;
use App\Filament\Resources\CalculatorSettings\Tables\CalculatorSettingsTable;
use App\Models\CalculatorSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CalculatorSettingResource extends Resource
{
    protected static ?string $model = CalculatorSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CalculatorSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CalculatorSettingsTable::configure($table);
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
            'index' => ListCalculatorSettings::route('/'),
            'create' => CreateCalculatorSetting::route('/create'),
            'edit' => EditCalculatorSetting::route('/{record}/edit'),
        ];
    }
}
