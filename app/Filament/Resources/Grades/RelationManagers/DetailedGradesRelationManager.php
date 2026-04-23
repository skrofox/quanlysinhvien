<?php

namespace App\Filament\Resources\Grades\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DetailedGradesRelationManager extends RelationManager
{
    protected static string $relationship = 'detailedGrades';

    protected static ?string $title = 'Chi tiết điểm các thành phần';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('semester.semester_name')
                    ->label('Học kỳ'),
                TextColumn::make('DCC')
                    ->label('Chuyên cần'),
                TextColumn::make('DGK')
                    ->label('Giữa kỳ'),
                TextColumn::make('DCK')
                    ->label('Cuối kỳ'),
                TextColumn::make('created_at')
                    ->label('Ngày nhập')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
