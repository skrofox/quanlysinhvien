<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('subject_code')
                    ->required(),
                TextInput::make('subject_name')
                    ->required(),
                TextInput::make('number_of_credits')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(10),
                Select::make("department_id")
                    ->relationship("department", "department_code")
                    ->preload()
                    ->required()
            ]);
    }
}
