<?php

namespace App\Filament\Resources\Lecturers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LecturerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('lecturer_code')
                ->label('Mã giảng viên'),
                TextEntry::make('full_name')
                ->label('Họ và tên')
                    ->placeholder('-'),
                TextEntry::make('birthday')
                ->label(('Ngày sinh'))
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('gender')
                ->label('Giới tính')
                    ->badge(),
                TextEntry::make('phone')
                ->label('Số điện thoại')
                    ->placeholder('-'),
                TextEntry::make('address')
                ->label('Địa chỉ')
                    ->placeholder('-'),
                TextEntry::make('department.department_name')
                    ->label('Khoa')
                    ->placeholder('-'),
                TextEntry::make('user.email')
                    ->label('Email')
                    ->placeholder('-'),
                TextEntry::make('user.name')
                    ->label('Tên tài khoản')
                    ->placeholder('-'),
                TextEntry::make('user.roles.name')
                    ->label('Vai trò')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
