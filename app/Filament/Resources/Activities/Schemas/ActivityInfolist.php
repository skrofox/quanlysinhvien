<?php

namespace App\Filament\Resources\Activities\Schemas;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;

class ActivityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsSection::make('Thông tin hoạt động')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('log_name')
                            ->label('Tên Log'),
                        TextEntry::make('event')
                            ->label('Sự kiện')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'created' => 'success',
                                'updated' => 'warning',
                                'deleted' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('description')
                            ->label('Mô tả')
                            ->columnSpanFull(),
                        TextEntry::make('subject_type')
                            ->label('Loại đối tượng'),
                        TextEntry::make('subject_id')
                            ->label('ID Đối tượng'),
                        TextEntry::make('causer.name')
                            ->label('Người thực hiện')
                            ->default('Hệ thống'),
                        TextEntry::make('created_at')
                            ->label('Thời gian thực hiện')
                            ->dateTime('H:i:s d/m/Y'),
                    ]),
                ComponentsSection::make('Chi tiết thay đổi')
                    ->visible(fn($record) => !empty($record->properties['attributes']) || !empty($record->properties['old']))
                    ->schema([
                        ViewEntry::make('properties')
                            ->label('Thay đổi')
                            ->view('filament.resources.activities.view-properties')
                    ])
            ]);
    }
}
