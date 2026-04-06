<?php

namespace App\Filament\Resources\Grades\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->label('Sinh viên')
                    ->relationship(
                        name: 'student',
                        titleAttribute: 'full_name',
                        modifyQueryUsing: fn ($query, $get) => $query->when(
                            $get('course_module_id'),
                            fn ($q, $moduleId) => $q->whereHas('courseRegistrations', fn ($qr) => $qr->where('course_module_id', $moduleId))
                        )
                    )
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),
                Select::make('course_module_id')
                    ->label('Lớp học phần (Môn học - Học kỳ - Giáo viên)')
                    ->relationship(
                        name: 'courseModule',
                        titleAttribute: 'id',
                        modifyQueryUsing: fn ($query, $get) => $query->when(
                            $get('student_id'),
                            fn ($q, $studentId) => $q->whereHas('courseRegistrations', fn ($qr) => $qr->where('student_id', $studentId))
                        )
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->subject->subject_name} - {$record->semester->semester_name} ({$record->semester->schoolYear->start_year} - {$record->semester->schoolYear->end_year}) - {$record->lecturer->full_name}")
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required()
                    ->rules([
                        fn ($get) => function (string $attribute, $value, $fail) use ($get) {
                            $studentId = $get('student_id');
                            if (!$studentId || !$value) return;

                            $student = \App\Models\Student::find($studentId);
                            if (!$student) return;

                            $exists = \App\Models\CourseRegistration::where('student_id', $student->user_id)
                                ->where('course_module_id', $value)
                                ->exists();

                            if (!$exists) {
                                $fail('Sinh viên này chưa đăng ký lớp học phần này.');
                            }
                        },
                    ]),

                TextInput::make('attendance_score')
                    ->label('Điểm chuyên cần')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(10),
                TextInput::make('midterm_score')
                    ->label('Điểm giữa kỳ')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(10),
                TextInput::make('final_score')
                    ->label('Điểm cuối kỳ')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(10),
                
                // Status is auto-calculated on save, so we omit it from form.
                \Filament\Forms\Components\Hidden::make('status')
                    ->default('pass'),
            ]);
    }
}
