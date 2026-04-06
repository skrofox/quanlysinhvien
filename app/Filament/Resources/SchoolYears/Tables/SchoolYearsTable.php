<?php

namespace App\Filament\Resources\SchoolYears\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class SchoolYearsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('start_year')
                    ->label('Năm bắt đầu')
                    ->numeric()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('end_year')
                    ->label('Năm kết thúc')
                    ->numeric()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('range')
                    ->label('Niên khóa / Năm học')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
