<?php

namespace App\Filament\Resources\CalculatorSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CalculatorSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Страна')->schema([

                    TextInput::make('country')
                        ->required()
                        ->label('Код страны (korea/china)'),

                    TextInput::make('currency')
                        ->label('Валюта'),

                    TextInput::make('currency_rate')
                        ->numeric()
                        ->label('Курс валюты'),

                ]),

                Section::make('Проценты')->schema([

                    TextInput::make('country_expense_percent')
                        ->numeric()
                        ->label('Расходы по стране %'),

                    TextInput::make('bank_percent')
                        ->numeric()
                        ->label('Комиссия банка %'),

                    TextInput::make('customs_percent')
                        ->numeric()
                        ->label('Таможня %'),

                ]),

                Section::make('Фиксированные расходы')->schema([

                    TextInput::make('delivery_price')
                        ->numeric()
                        ->label('Доставка'),

                    TextInput::make('company_fee')
                        ->numeric()
                        ->label('Комиссия компании'),

                    TextInput::make('russia_expenses')
                        ->numeric()
                        ->label('Расходы в РФ'),

                    TextInput::make('util_fee')
                        ->numeric()
                        ->label('Утиль сбор'),

                    TextInput::make('customs_fee')
                        ->numeric()
                        ->label('Таможенный сбор'),

                ]),
            ]);
    }
}
