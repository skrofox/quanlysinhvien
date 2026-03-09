<?php

namespace App\Filament\Resources\CourseModules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CourseModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('subject_id')
                    ->relationship("subject", "subject_code")
                    ->required()
                    ->preload(),
                Select::make('semester_id')
                    ->relationship("semester", "semester_name")
                    ->required()
                    ->preload(),
                Select::make('lecturer_id')
                    ->relationship(
                        name: 'lecturer',
                        titleAttribute: 'full_name'
                    )
                    ->getOptionLabelFromRecordUsing(fn($record) =>
                        'Mã GV: ' . $record->lecturer_code . ' - ' . $record->full_name)
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('number_of_students')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->default(0),
            ]);
    }
}
