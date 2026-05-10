<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('title')
                                    ->label('Tiêu đề')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state) . '-' . time()) : null),
                                TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(\App\Models\News::class, 'slug', ignoreRecord: true),
                                Textarea::make('summary')
                                    ->label('Tóm tắt')
                                    ->rows(3),
                                \Filament\Forms\Components\RichEditor::make('content')
                                    ->label('Nội dung')
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDisk('public')
                                       ->fileAttachmentsDirectory('news-content'),
                            ])
                            ->columnSpan(2),
                        Section::make()
                            ->schema([
                                \Filament\Forms\Components\Select::make('category_id')
                                    ->label('Thể loại')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                \Filament\Forms\Components\Select::make('status')
                                    ->label("Trạng thái")
                                    ->options([
                                        'published' => 'Công khai',
                                        'draft' => 'Bản nháp',
                                    ])
                                    ->required()
                                    ->default('published'),
                                Toggle::make('is_featured')
                                    ->label('Tin nổi bật'),
                                FileUpload::make('thumbnail')
                                    ->label('Hình ảnh')
                                    ->image()
                                    ->disk('public')
                                    ->directory('news-thumbnails'),
                                DateTimePicker::make('published_at')
                                    ->label('Ngày đăng')
                                    ->default(now()),
                                Hidden::make('user_id')
                                    ->default(Auth::id()),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
