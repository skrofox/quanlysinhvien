<?php

namespace App\Filament\Resources\Lecturers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LecturerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('lecturer_code')
                    ->required(),
                TextInput::make('full_name'),
                DatePicker::make('birthday'),
                Select::make('gender')
                    ->options(['Nam' => 'Nam', 'Nữ' => 'Nữ', 'Khác' => 'Khác'])
                    ->default('Khác')
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('address'),
                Select::make('user_id')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) =>
                        $query->role('giang_vien')
                    )
                    ->getOptionLabelFromRecordUsing(fn($record) =>
                        'ID: ' . $record->id . ' - ' . $record->name)
                    ->required(),
            ]);
    }
}
