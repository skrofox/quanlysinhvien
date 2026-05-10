<?php

namespace App\Filament\Resources\Lecturers\Schemas;

use App\Models\Lecturer;
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
                    ->label('Mã giảng viên')

                    ->default(function () {

                        $lastLecturer = Lecturer::latest('id')->first();

                        if (!$lastLecturer) {
                            return 'GV001';
                        }

                        $number = (int) str_replace(
                            'GV',
                            '',
                            $lastLecturer->lecturer_code
                        );

                        return 'GV' . str_pad(
                            $number + 1,
                            3,
                            '0',
                            STR_PAD_LEFT
                        );
                    })

                    ->disabled()
                    ->dehydrated()
                    ->required(),

                TextInput::make('full_name')
                    ->label('Họ và tên')
                    ->required(),

                DatePicker::make('birthday')
                    ->label('Ngày sinh'),

                Select::make('gender')
                    ->label('Giới tính')
                    ->options([
                        'Nam' => 'Nam',
                        'Nữ' => 'Nữ',
                        'Khác' => 'Khác',
                    ])
                    ->default('Khác')
                    ->required(),

                TextInput::make('phone')
                    ->label('Số điện thoại')
                    ->tel(),

                TextInput::make('address')
                    ->label('Địa chỉ'),

                Select::make('department_id')
                    ->label('Khoa')
                    ->relationship('department', 'department_name')
                    ->searchable()
                    ->preload()
                    ->required(),

            ]);
    }
}