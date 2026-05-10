<?php

namespace App\Filament\Resources\CourseRegistrations;

use App\Filament\Resources\CourseRegistrations\Pages\CreateCourseRegistration;
use App\Filament\Resources\CourseRegistrations\Pages\EditCourseRegistration;
use App\Filament\Resources\CourseRegistrations\Pages\ListCourseRegistrations;
use App\Filament\Resources\CourseRegistrations\Pages\ViewCourseRegistration;
use App\Filament\Resources\CourseRegistrations\Schemas\CourseRegistrationForm;
use App\Filament\Resources\CourseRegistrations\Schemas\CourseRegistrationInfolist;
use App\Filament\Resources\CourseRegistrations\Tables\CourseRegistrationsTable;
use App\Models\CourseRegistration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CourseRegistrationResource extends Resource
{
    protected static ?string $model = CourseRegistration::class;

    protected static ?string $modelLabel = 'Đăng ký môn học';
    protected static ?string $pluralModelLabel = 'Danh sách Đăng ký';
    protected static string|\UnitEnum|null $navigationGroup = 'Đào tạo';
    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    public static function form(Schema $schema): Schema
    {
        return CourseRegistrationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CourseRegistrationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CourseRegistrationsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->leftJoin('course_modules', 'course_registrations.course_module_id', '=', 'course_modules.id')
            ->leftJoin('semesters', 'course_modules.semester_id', '=', 'semesters.id')
            ->select('course_registrations.*')
            ->orderByRaw("CASE WHEN semesters.status = 'ongoing' THEN 0 ELSE 1 END")
            ->orderBy('course_registrations.id', 'desc');
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
            'index' => ListCourseRegistrations::route('/'),
            'create' => CreateCourseRegistration::route('/create'),
            'view' => ViewCourseRegistration::route('/{record}'),
            'edit' => EditCourseRegistration::route('/{record}/edit'),
        ];
    }
}
