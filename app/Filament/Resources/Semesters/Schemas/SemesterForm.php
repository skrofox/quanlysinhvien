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
                Select::make('academic_year_id')
                    ->label("Niên Khóa")
                    ->relationship("academicYear", "start_year")
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->range)
                    ->required()
            ]);
    }
}
