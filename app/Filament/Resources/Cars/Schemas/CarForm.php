<?php

namespace App\Filament\Resources\Cars\Schemas;

use App\Models\Brand;
use App\Models\CarModel;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основное')
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->label('Категория (происхождение)')
                            ->placeholder('Выберите категорию')
                            ->nullable(),
                        Select::make('brand_id')
                            ->label('Марка')
                            ->options(Brand::pluck('name', 'id'))
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('model_id', null))
                            ->required(),
                        Select::make('model_id')
                            ->label('Модель')
                            ->options(function (callable $get) {
                                $brandId = $get('brand_id');
                                if (!$brandId) return [];
                                return CarModel::where('brand_id', $brandId)->pluck('name', 'id');
                            })
                            ->required(),
                        TextInput::make('lot')
                            ->label('Номер лота')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('title')
                            ->label('Заголовок (можно генерировать)'),
                    ])->columns(2),

                Section::make('Год и пробег')
                    ->schema([
                        Select::make('year')
                            ->label('Год выпуска')
                            ->options(array_combine(range(date('Y')+1, 1990), range(date('Y')+1, 1990)))
                            ->required(),
                        Select::make('month')
                            ->label('Месяц выпуска')
                            ->options([
                                1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель',
                                5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август',
                                9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь',
                            ])
                            ->nullable(),
                        TextInput::make('mileage')
                            ->label('Пробег (км)')
                            ->numeric()
                            ->integer(),
                    ])->columns(3),

                Section::make('Технические характеристики')
                    ->schema([
                        Select::make('body_type')
                            ->label('Кузов')
                            ->options([
                                'vnedorozhnik' => 'Внедорожник',
                                'mikroavtobus' => 'Микроавтобус',
                                'pikap' => 'Пикап',
                                'sedan' => 'Седан',
                                'sportkar' => 'Спорткар',
                                'hetchbek' => 'Хэтчбек',
                            ])
                            ->required(),
                        Select::make('engine_type')
                            ->label('Тип двигателя')
                            ->options([
                                'elektromobil' => 'Электромобиль',
                                'benzin' => 'Бензин',
                                'diesel' => 'Дизель',
                                'gibrid' => 'Гибрид',
                            ])
                            ->required(),
                        TextInput::make('engine_power')
                            ->label('Мощность (кВт)')
                            ->numeric(),
                        TextInput::make('engine_power_30min')
                            ->label('30-мин. мощность (кВт)')
                            ->numeric(),
                        TextInput::make('engine_volume')
                            ->label('Объем двигателя (см³)')
                            ->numeric(),
                        Select::make('drive')
                            ->label('Привод')
                            ->options([
                                '4wd' => '4WD',
                                'zadniy' => 'Задний',
                                'peredniy' => 'Передний',
                                'polnyy-privod-po-centru' => 'Полный привод по центру',
                                'srednemotornaya-zadneprivodnaya' => 'Среднемоторная заднеприводная',
                                'tri-motora-i-polnyy-privod' => 'Три мотора и полный привод',
                                'chetyre-motora-i-polnyy-privod' => 'Четыре мотора и полный привод',
                            ]),
                        Select::make('transmission')
                            ->label('Трансмиссия')
                            ->options([
                                'automatic' => 'Автоматическая',
                                'mechanical' => 'Механическая',
                                'variator' => 'Вариатор',
                                'robot' => 'Робот',
                            ]),
                        TextInput::make('color')
                            ->label('Цвет'),
                    ])->columns(2),

                Section::make('Цены')
                    ->schema([
                        TextInput::make('price_china')
                            ->label('Цена в Китае (¥)')
                            ->numeric(),
                        TextInput::make('price_russia')
                            ->label('Цена в России (₽)')
                            ->numeric(),
                    ])->columns(2),

                Section::make('Дополнительно')
                    ->schema([
                        Checkbox::make('is_min_util')
                            ->label('Льготный утильсбор'),
                        Checkbox::make('is_passable')
                            ->label('Показать проходные'),
                        TextInput::make('source_url')
                            ->label('Ссылка на источник')
                            ->url(),
                        TextInput::make('source_site')
                            ->label('Название сайта'),
                        RichEditor::make('description')
                            ->extraAttributes(['style' => 'min-height: 300px;'])
                            ->label('Описание'),
                    ])->columns(1)
                        ->columnSpanFull(), // опционально, если секция вложена в двухколоночный макет

                Section::make('Галерея')
                    ->schema([
                        Repeater::make('images')
                            ->relationship('images')
                            ->schema([
                                FileUpload::make('path')
                                    ->label('Изображение')
                                    ->image()
                                    ->disk('public')
                                    ->imageResizeMode(null)
                                    ->directory('cars')
                                    ->required(),
                                TextInput::make('sort_order')
                                    ->label('Порядок')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->orderable('sort_order')
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
