<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->required()
                    ->dehydrated() // 🔥 ВАЖНО (иначе не отправится!)
                    ->unique(ignoreRecord: true),

                TextInput::make('h1')
                    ->label('H1'),

                TextInput::make('seo_title')
                    ->label('SEO Title'),

                Textarea::make('seo_description')
                    ->label('SEO Description')
                    ->rows(3),

                TextInput::make('seo_keywords')
                    ->label('SEO Keywords'),



                Select::make('topic_id')
                    ->label('Тема')
                    ->options(\App\Models\Topic::pluck('title', 'id'))
                    ->searchable()
                    ->required(),

                Textarea::make('description')
                    ->required(),
                Textarea::make('schema_sql')
                    ->label('SQL для создания таблиц (seed)')
                    ->rows(10),

                Textarea::make('expected_sql')
                    ->label('Правильный SQL'),


                RichEditor::make('hint')
                    ->label('Подсказка')
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'min-height: 500px;',
                    ]),


                Textarea::make('table_preview')
                    ->label('Авто-сгенерированный preview')
                    ->rows(10),
            ]);
    }
}
