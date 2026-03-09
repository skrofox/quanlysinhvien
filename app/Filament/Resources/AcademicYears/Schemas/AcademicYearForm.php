<?php

namespace App\Filament\Resources\AcademicYears\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AcademicYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('start_year')
                    ->label("Năm bắt đầu")
                    ->numeric()
                    ->maxLength(4)
                    ->rules(['required', 'digits:4'])
                    ->minValue(1900)
                    ->maxValue(date('Y'))
                    ->required(),
                TextInput::make('end_year')
                    ->label("Năm kết thúc")
                    ->numeric()
                    ->maxLength(4)
                    ->rules(['required', 'digits:4', 'gte:start_year'])
                    ->required(),
            ]);
    }
}
