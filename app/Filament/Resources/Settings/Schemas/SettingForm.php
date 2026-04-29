<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('owner_name')
                    ->label('ФИО'),

                TextInput::make('inn')
                    ->label('ИНН'),

                TextInput::make('email')
                    ->email(),

                TextInput::make('phone')
                    ->label('Телефон'),

                TextInput::make('telegram')
                    ->label('Telegram'),

                TextInput::make('address')
                    ->label('Адрес'),
            ]);
    }
}
