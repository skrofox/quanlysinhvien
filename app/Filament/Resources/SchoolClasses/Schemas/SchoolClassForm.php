<?php

namespace App\Filament\Resources\SchoolClasses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SchoolClassForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('class_code')
                    ->label("Mã lớp")
                    ->required(),
                TextInput::make('class_name')
                    ->label("Tên lớp"),
                Select::make('department_id')
                    ->label("Khoa")
                    ->relationship("department", "department_name")
                    ->required(),
                Select::make('academic_year_id')
                    ->label("Năm học")
                    ->relationship("academic_year", "start_year")
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->range)
                    ->required()
            ]);
    }
}
