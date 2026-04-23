<?php

namespace App\Filament\Resources\Grades\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.full_name')
                    ->label('Sinh viên')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('course_module_info')
                    ->label('Lớp học phần')
                    ->getStateUsing(fn ($record) => $record->courseModule ? "{$record->courseModule->subject->subject_name} - {$record->courseModule->semester->semester_name} - {$record->courseModule->lecturer->full_name}" : '')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('academicBatch.range')
                    ->label('Khóa học')
                    ->sortable(),
                TextColumn::make('attendance_score')
                    ->label('Chuyên cần')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('L1')
                    ->label('Lần 1')
                    ->sortable(),
                TextColumn::make('L2')
                    ->label('Lần 2')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('L3')
                    ->label('Lần 3')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('L4')
                    ->label('Lần 4')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('average_score')
                    ->label('Trung bình')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn ($state) => $state === 'pass' ? 'success' : 'danger')
                    ->formatStateUsing(fn ($state) => $state === 'pass' ? 'Đạt' : 'Trượt'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
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
