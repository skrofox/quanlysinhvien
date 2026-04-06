<?php

namespace App\Filament\Resources\AcademicBatches;

use App\Filament\Resources\AcademicBatches\Pages\CreateAcademicBatch;
use App\Filament\Resources\AcademicBatches\Pages\EditAcademicBatch;
use App\Filament\Resources\AcademicBatches\Pages\ListAcademicBatches;
use App\Filament\Resources\AcademicBatches\Schemas\AcademicBatchForm;
use App\Filament\Resources\AcademicBatches\Tables\AcademicBatchesTable;
use App\Models\AcademicBatch;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AcademicBatchResource extends Resource
{
    protected static ?string $model = AcademicBatch::class;

    protected static ?string $modelLabel = 'Khóa học';
    protected static ?string $pluralModelLabel = 'Khóa học (Niên khóa)';
    protected static string|\UnitEnum|null $navigationGroup = 'Quản lý Danh mục';
    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    public static function form(Schema $schema): Schema
    {
        return AcademicBatchForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademicBatchesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAcademicBatches::route('/'),
            'create' => CreateAcademicBatch::route('/create'),
            'edit' => EditAcademicBatch::route('/{record}/edit'),
        ];
    }
}
