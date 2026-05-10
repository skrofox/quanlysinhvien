<?php

namespace App\Filament\Resources\Grades;

use App\Filament\Resources\Grades\Pages\CreateGrade;
use App\Filament\Resources\Grades\Pages\EditGrade;
use App\Filament\Resources\Grades\Pages\ListGrades;
use App\Filament\Resources\Grades\Pages\ViewGrade;
use App\Filament\Resources\Grades\Schemas\GradeForm;
use App\Filament\Resources\Grades\Schemas\GradeInfolist;
use App\Filament\Resources\Grades\Tables\GradesTable;
use App\Models\Grade;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $modelLabel = 'Điểm';
    protected static ?string $pluralModelLabel = 'Quản lý điểm';
    protected static string|\UnitEnum|null $navigationGroup = 'Đào tạo';
    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPresentationChartLine;

    public static function form(Schema $schema): Schema
    {
        return GradeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GradeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GradesTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->leftJoin('course_modules', 'grades.course_module_id', '=', 'course_modules.id')
            ->leftJoin('semesters', 'course_modules.semester_id', '=', 'semesters.id')
            ->select('grades.*')
            ->orderByRaw("CASE WHEN semesters.status = 'ongoing' THEN 0 ELSE 1 END")
            ->orderBy('grades.id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\Grades\RelationManagers\DetailedGradesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGrades::route('/'),
            'create' => CreateGrade::route('/create'),
            'view' => ViewGrade::route('/{record}'),
            'edit' => EditGrade::route('/{record}/edit'),
        ];
    }
}
