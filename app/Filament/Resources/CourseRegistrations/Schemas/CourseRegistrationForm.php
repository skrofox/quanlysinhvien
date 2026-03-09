<?php

namespace App\Filament\Resources\CourseRegistrations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CourseRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->relationship(
                        name: 'student',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) =>
                        $query->role('sinh_vien')->with('student')
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) =>
                        $record->student?->student_code . ' - ' . $record->name
                    )
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('course_module_id')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('registration_date')
                    ->required(),
            ]);
    }
}
