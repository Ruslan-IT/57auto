<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use App\Models\BlogPost;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogPostForm
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
                    ->unique(BlogPost::class, 'slug', ignoreRecord: true),
                FileUpload::make('image')
                    ->label('Фотография')
                    ->image()
                    ->disk('public')
                    ->directory('blog')
                    ->visibility('public')
                    ->fetchFileInformation(false)
                    ->getUploadedFileUsing(function (FileUpload $component, string $file): ?array {
                        $url = $component->getDisk()->url($file);
                        $path = parse_url($url, PHP_URL_PATH);

                        return [
                            'name' => basename($file),
                            'size' => 0,
                            'type' => null,
                            'url' => $path ?: $url,
                        ];
                    })
                    ->imageResizeMode(null)
                    ->columnSpanFull(),
                Textarea::make('excerpt')
                    ->label('Краткое описание')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Текст статьи')
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->label('Опубликовано')
                    ->default(true),
                DateTimePicker::make('published_at')
                    ->label('Дата публикации'),
            ]);
    }
}
