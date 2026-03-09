<?php

namespace App\Filament\Resources\Activities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("log_name")
                    ->label("Loại Log")
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("description")
                    ->label("Mô tả")
                    ->searchable(),
                TextColumn::make("subject_type")
                    ->label("Đối tượng")
                    ->formatStateUsing(fn($state) => str_replace('App\\Models\\', '', $state))
                    ->searchable(),
                TextColumn::make("event")
                    ->label("Hành động")
                    ->formatStateUsing(fn($state) => match ($state) {
                        'created' => 'Đã tạo',
                        'updated' => 'Đã cập nhật',
                        'deleted' => 'Đã xóa',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make("subject_id")
                    ->label("ID Đối tượng")
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("causer.name")
                    ->label("Người thực hiện")
                    ->searchable()
                    ->default('Hệ thống'),
                TextColumn::make("created_at")
                    ->label("Thời gian")
                    ->dateTime('H:i d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Xem chi tiết'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
