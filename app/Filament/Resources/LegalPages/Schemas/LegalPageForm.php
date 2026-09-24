<?php

namespace App\Filament\Resources\LegalPages\Schemas;

use App\Models\LegalPage;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LegalPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Название')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (callable $set, $state, $get) {
                        if (!$get('slug')) {
                            $set('slug', Str::slug($state));
                        }
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(LegalPage::class, 'slug', ignoreRecord: true),
                RichEditor::make('content')
                    ->label('Текст')
                    ->columnSpanFull(),
            ]);
    }
}
