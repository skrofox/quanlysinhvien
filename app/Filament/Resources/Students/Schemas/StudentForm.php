<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_code')
                    ->required(),
                TextInput::make('full_name')
                    ->required(),
                DatePicker::make('birthday'),
                Select::make('gender')
                    ->options(['Nam' => 'Nam', 'Nữ' => 'Nữ', 'Khác' => 'Khác'])
                    ->default('Khác')
                    ->required(),
                Select::make('school_class_id')
                    ->relationship('schoolClass', 'class_code')
                    ->required()
                    ->searchable()
                    ->preload(),
            ]);
    }
}
