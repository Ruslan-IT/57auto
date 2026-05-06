<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Название бренда')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true) // для автоматической генерации слага
                    ->afterStateUpdated(fn (callable $set, $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->label('Слаг')
                    ->required()
                    ->unique(ignoreRecord: true),

            ]);
    }
}
