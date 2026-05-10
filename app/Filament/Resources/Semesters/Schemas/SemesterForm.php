<?php

namespace App\Filament\Resources\Semesters\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SemesterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('semester_name')
                    ->required(),
                Select::make('school_year_id')
                    ->label("Năm học")
                    ->relationship("schoolYear", "start_year")
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->range)
                    ->required(),
                Select::make('status')
                    ->label("Trạng thái")
                    ->options([
                        'upcoming' => 'Sắp diễn ra',
                        'ongoing' => 'Đang diễn ra',
                        'finished' => 'Đã kết thúc',
                    ])
                    ->default('upcoming')
                    ->required(),
            ]);
    }
}
