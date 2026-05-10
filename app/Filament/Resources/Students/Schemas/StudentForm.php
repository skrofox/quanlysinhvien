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
                    ->label('Mã sinh viên')
                    ->required(),
                TextInput::make('full_name')
                    ->label('Họ tên')
                    ->required(),
                DatePicker::make('birthday')
                    ->label('Ngày sinh'),
                Select::make('gender')
                    ->label('Giới tính')
                    ->options(['Nam' => 'Nam', 'Nữ' => 'Nữ', 'Khác' => 'Khác'])
                    ->default('Khác')
                    ->required(),
                Select::make('school_class_id')
                    ->label('Lớp')
                    ->relationship('schoolClass', 'class_code')
                    ->required()
                    ->searchable()
                    ->preload(),
                // Select::make('user_id')

                    // ->relationship(
                    //     name: 'user',
                    //     titleAttribute: 'name',
                    //     modifyQueryUsing: fn($query) =>
                    //     $query->role('sinh_vien')
                    // )
                    // ->getOptionLabelFromRecordUsing(fn($record) =>
                    //     'ID: ' . $record->id . ' - ' . $record->name)
                    // ->required(),
                TextInput::make('CCCD')
                ->label("CCCD/CMND")
                    ->required(),
            ]);
    }
}
