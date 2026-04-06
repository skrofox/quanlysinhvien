<?php

namespace App\Filament\Resources\SchoolYears\Schemas;

use Filament\Schemas\Schema;

class SchoolYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('start_year')
                    ->label('Năm bắt đầu')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(2100),
                \Filament\Forms\Components\TextInput::make('end_year')
                    ->label('Năm kết thúc')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(2100),
            ]);
    }
}
