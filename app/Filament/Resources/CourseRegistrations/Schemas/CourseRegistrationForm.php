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
                    ->label('Sinh viên')
                    ->relationship(
                        name: 'student',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) =>
                        $query->role('sinh_vien')->with('student')
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) =>
                        ($record->student?->student_code ?? 'N/A') . ' - ' . $record->name
                    )
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('course_module_id')
                    ->label('Lớp học phần')
                    ->relationship('courseModule', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->subject->subject_name} ({$record->semester->semester_name} {$record->semester->schoolYear?->range}) - {$record->lecturer->full_name}")
                    ->searchable()
                    ->preload()
                    ->required(),
                DateTimePicker::make('registration_date')
                    ->label('Ngày đăng ký')
                    ->default(now())
                    ->required(),
            ]);
    }
}
