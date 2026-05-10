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
                    ->label('Môn học')
                    ->relationship(
                        name: "subject",
                        titleAttribute: "subject_name"
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->subject_name} ({$record->subject_code})")
                    ->required()
                    ->live()
                    ->preload(),
                Select::make('semester_id')
                    ->label('Học kỳ')
                    ->relationship("semester", "semester_name")
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->semester_name} ({$record->schoolYear?->start_year} - {$record->schoolYear?->end_year})")
                    ->default(fn () => \App\Models\Semester::where('status', 'ongoing')->value('id'))
                    ->required()
                    ->preload(),
                Select::make('lecturer_id')
                    ->label('Giảng viên')
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
                    ->label('Số lượng sinh viên')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->default(0),
                \Filament\Forms\Components\Toggle::make('is_completed')
                    ->label('Đã đóng (Hoàn thành)')
                    ->default(false)
                    ->inline(false),
            ]);
    }
}
