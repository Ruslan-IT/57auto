<?php

namespace App\Filament\Resources\FormSubmissions\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;

class FormSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('data')
                    ->label('Данные')
                    ->formatStateUsing(fn ($state) =>
                    json_encode($state, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
                    )
                    ->rows(10)
                    ->disabled(), // только просмотр

            ]);
    }
}
