<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Название категории')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (callable $set, $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->label('Слаг (URL)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Будет использован в URL. Должен быть уникальным.'),
            ]);
    }
}
