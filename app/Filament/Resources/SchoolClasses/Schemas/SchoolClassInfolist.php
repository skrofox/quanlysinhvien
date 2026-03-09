<?php

namespace App\Filament\Resources\SchoolClasses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SchoolClassInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('class_code'),
                TextEntry::make('class_name')
                    ->placeholder('-'),
                TextEntry::make('department.department_name')
                    ->label("Thuộc Khoa"),
                TextEntry::make('academic_year.range')
                    ->label("Năm học"),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
