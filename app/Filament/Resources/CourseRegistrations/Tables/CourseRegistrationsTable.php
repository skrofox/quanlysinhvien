<?php

namespace App\Filament\Resources\CourseRegistrations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CourseRegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.student.student_code')
                    ->label("Mã SV")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('student.name')
                    ->label("Họ tên")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('courseModule.subject.subject_name')
                    ->label('Môn học')
                    ->formatStateUsing(fn ($record) => "{$record->courseModule->subject->subject_name} ({$record->courseModule->semester->semester_name} {$record->courseModule->semester->schoolYear?->range})")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('registration_date')
                    ->label('Ngày đăng ký')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
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
