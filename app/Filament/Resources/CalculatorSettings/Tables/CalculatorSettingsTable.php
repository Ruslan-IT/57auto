<?php

namespace App\Filament\Resources\CalculatorSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CalculatorSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('country')
                    ->label('Страна'),

                TextColumn::make('currency')
                    ->label('Валюта'),

                TextColumn::make('currency_rate')
                    ->label('Курс'),

                TextColumn::make('bank_percent')
                    ->label('Банк %'),

                TextColumn::make('delivery_price')
                    ->label('Доставка'),

                TextColumn::make('company_fee')
                    ->label('Комиссия'),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
