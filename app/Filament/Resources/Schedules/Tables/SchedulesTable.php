<?php

namespace App\Filament\Resources\Schedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('courseModule.subject.subject_name')
                    ->label('Lớp học phần')
                    ->formatStateUsing(fn ($record) => "{$record->courseModule->subject->subject_name} - {$record->courseModule->semester->semester_name}")
                    ->searchable()
                    ->sortable(),

                TextColumn::make('monday')
                    ->label('T2')
                    ->toggleable(),
                TextColumn::make('tuesday')
                    ->label('T3')
                    ->toggleable(),
                TextColumn::make('wednesday')
                    ->label('T4')
                    ->toggleable(),
                TextColumn::make('thursday')
                    ->label('T5')
                    ->toggleable(),
                TextColumn::make('friday')
                    ->label('T6')
                    ->toggleable(),
                TextColumn::make('saturday')
                    ->label('T7')
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
