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
                    ->relationship(
                        name: "subject",
                        titleAttribute: "subject_name",
                        modifyQueryUsing: fn ($query, $component) => $query->whereDoesntHave('courseModules', function ($q) use ($component) {
                            $record = $component->getRecord();
                            if ($record) {
                                $q->where('id', '!=', $record->id);
                            }
                        })
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->subject_name} ({$record->subject_code})")
                    ->required()
                    ->live()
                    ->preload(),
                Select::make('semester_id')
                    ->label('Học kỳ')
                    ->relationship("semester", "semester_name")
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->semester_name} ({$record->schoolYear?->start_year} - {$record->schoolYear?->end_year})")
                    ->required()
                    ->preload()
                    ->rules([
                        fn ($get) => function (string $attribute, $value, $fail) use ($get) {
                            $subjectId = $get('subject_id');
                            if (!$subjectId || !$value) return;

                            $semester = \App\Models\Semester::find($value);
                            if (!$semester) return;

                            $schoolYearId = $semester->school_year_id;

                            $exists = \App\Models\CourseModule::where('subject_id', $subjectId)
                                ->whereHas('semester', function ($query) use ($schoolYearId) {
                                    $query->where('school_year_id', $schoolYearId);
                                })
                                ->when($get('../../id'), fn ($query, $id) => $query->where('id', '!=', $id))
                                ->exists();

                            if ($exists) {
                                $fail('Môn học này đã được mở lớp trong một học kỳ khác thuộc cùng năm học.');
                            }
                        },
                    ]),
                Select::make('lecturer_id')
                    ->relationship(
                        name: 'lecturer',
                        titleAttribute: 'full_name',
                        modifyQueryUsing: fn ($query, $get) => $query->when(
                            $get('subject_id'),
                            fn($q, $subjectId) => $q->where('department_id', \App\Models\Subject::find($subjectId)?->department_id)
                        )
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
