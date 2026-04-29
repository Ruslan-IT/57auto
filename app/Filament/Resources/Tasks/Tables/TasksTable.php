<?php

namespace App\Filament\Resources\Tasks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->formatStateUsing(fn ($state) => $state - 63)
                    ->searchable(),
                TextColumn::make('title')->searchable(),
                TextColumn::make('seo_title')->searchable(),
                TextColumn::make('topic.title')
                    ->label('Тема'),

            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('topic_id')
                    ->label('Тема')
                    ->relationship('topic', 'title') // 🔥 ключевая строка
            ])
            ->persistFiltersInSession()

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
