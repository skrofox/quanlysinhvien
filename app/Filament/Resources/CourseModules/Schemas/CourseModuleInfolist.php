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
                TextEntry::make('subject_id')
                    ->numeric(),
                TextEntry::make('semester_id')
                    ->numeric(),
                TextEntry::make('lecturer_id')
                    ->numeric(),
                TextEntry::make('number_of_students')
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
