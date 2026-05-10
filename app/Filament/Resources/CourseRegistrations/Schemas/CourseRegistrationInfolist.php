<?php

namespace App\Filament\Resources\CourseRegistrations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CourseRegistrationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('student.student.student_code')
                    ->label("Mã SV")
                    ->numeric(),
                TextEntry::make('student.name')
                    ->label("Họ tên")
                    ->numeric(),
                TextEntry::make('courseModule.subject.subject_name')
                    ->label('Môn học')
                    ->numeric(),
                    TextEntry::make('schedule.id')
    ->label('Lịch học')
    ->formatStateUsing(function ($record) {
        if (!$record->schedule) return 'N/A';

        $s = $record->schedule;

        $days = [
            'T2' => $s->monday,
            'T3' => $s->tuesday,
            'T4' => $s->wednesday,
            'T5' => $s->thursday,
            'T6' => $s->friday,
            'T7' => $s->saturday,
            'CN' => $s->sunday,
        ];

        $result = [];

        foreach ($days as $day => $value) {
            if (!empty($value)) {
                $result[] = "$day: $value";
            }
        }

        return empty($result) ? 'Không có lịch' : implode('<br>', $result);
    })
    ->html(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
