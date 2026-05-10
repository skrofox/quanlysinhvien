<?php

namespace App\Filament\Resources\CourseModules\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CourseModuleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('subject.subject_name')
                    ->label('Môn học')
                    ->numeric(),
                TextEntry::make('semester.semester_name')
                    ->label('Học kỳ')
                    ->numeric(),
                TextEntry::make('lecturer.full_name')
                    ->label('Giảng viên')
                    ->numeric(),
                TextEntry::make('number_of_students')
                ->label('Số lượng sinh viên')
                    ->numeric(),
                TextEntry::make('semester.schoolYear.range')
                ->label('Năm học')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
