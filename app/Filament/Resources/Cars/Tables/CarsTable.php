<?php

namespace App\Filament\Resources\Cars\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('brand.name')->label('Марка'),
                TextColumn::make('model.name')->label('Модель'),
                TextColumn::make('year'),
                TextColumn::make('price_russia')->label('Цена, ₽'),
                IconColumn::make('is_min_util')->boolean(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([

                // Фильтр по категории (происхождению)
                SelectFilter::make('category_id')
                    ->label('Категория')
                    ->relationship('category', 'name')
                    ->placeholder('Все категории'),

                // Дополнительные полезные фильтры:
                SelectFilter::make('brand_id')
                    ->label('Марка')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->placeholder('Все марки'),

                SelectFilter::make('year')
                    ->label('Год выпуска')
                    ->options(array_combine(range(date('Y'), 1990), range(date('Y'), 1990))),

                TernaryFilter::make('is_min_util')
                    ->label('Льготный утильсбор'),
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
