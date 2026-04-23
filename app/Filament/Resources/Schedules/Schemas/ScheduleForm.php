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
                    ->description('Quản lý thời khóa biểu cho từng lớp học phần.')
                    ->schema([
                        Select::make('course_module_id')
                            ->label('Lớp học phần')
                            ->relationship('courseModule', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->subject->subject_name} - {$record->semester->semester_name} ({$record->semester->schoolYear->start_year} - {$record->semester->schoolYear->end_year}) - {$record->lecturer->full_name}")
                            ->required()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),

                        TextInput::make('monday')
                            ->label('Thứ 2')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                        TextInput::make('tuesday')
                            ->label('Thứ 3')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                        TextInput::make('wednesday')
                            ->label('Thứ 4')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                        TextInput::make('thursday')
                            ->label('Thứ 5')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                        TextInput::make('friday')
                            ->label('Thứ 6')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                        TextInput::make('saturday')
                            ->label('Thứ 7')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}
