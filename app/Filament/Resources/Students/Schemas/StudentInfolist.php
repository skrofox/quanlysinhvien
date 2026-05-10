<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('student_code')
                ->label('Mã sinh viên'),
                TextEntry::make('full_name')
                ->label('Họ tên'),
                TextEntry::make('birthday')
                ->label('Ngày sinh')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('gender')
                    ->label('Giới tính')
                    ->badge(),
                TextEntry::make('schoolClass.class_code')
                    ->label('Lớp')
                    ->numeric(),
                    TextEntry::make('CCCD')
                    ->label("CCCD/CMND"),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),

            ]);
    }
}
