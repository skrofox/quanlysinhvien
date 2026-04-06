<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin Lịch học (Schedule)')
                    ->description('Quản lý các tệp tin lịch học, thời khóa biểu cho từng học kỳ và khóa học.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Tên lịch học')
                            ->placeholder('Ví dụ: TKB Học kỳ 1 - Khóa 2022')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Select::make('semester_id')
                            ->label('Học kỳ')
                            ->relationship('semester', 'semester_name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('academic_batch_id')
                            ->label('Khóa học')
                            ->relationship('academicBatch', 'start_year')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->start_year} - {$record->end_year}")
                            ->required()
                            ->searchable()
                            ->preload(),

                        FileUpload::make('file_path')
                            ->label('Tệp tin (.xlsx, .xls)')
                            ->disk('public')
                            ->directory('schedules')
                            ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                            ->maxSize(10240)
                            ->nullable(),

                        TextInput::make('drive_link')
                            ->label('Link Google Drive')
                            ->placeholder('https://drive.google.com/...')
                            ->url()
                            ->nullable(),

                        Toggle::make('is_active')
                            ->label('Trạng thái hiển thị')
                            ->default(true),
                    ])->columns(2),
            ]);
    }
}
