<?php

namespace App\Filament\Widgets;

use App\Models\AcademicYear;
use App\Models\CourseModule;
use App\Models\Department;
use App\Models\Lecturer;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;

use App\Filament\Resources\AcademicYears\AcademicYearResource;
use App\Filament\Resources\CourseModules\CourseModuleResource;
use App\Filament\Resources\Departments\DepartmentResource;
use App\Filament\Resources\Lecturers\LecturerResource;
use App\Filament\Resources\SchoolClasses\SchoolClassResource;
use App\Filament\Resources\Students\StudentResource;
use App\Filament\Resources\Subjects\SubjectResource;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Lớp học phần', CourseModule::count())
                ->icon('heroicon-o-book-open')
                ->color('info')
                ->url(CourseModuleResource::getUrl('index')),

            Stat::make('Khoa', Department::count())
                ->icon('heroicon-o-building-office-2')
                ->color('info')
                ->url(DepartmentResource::getUrl('index')),

            Stat::make('Lớp hành chính', SchoolClass::count())
                ->icon('heroicon-o-user-group')
                ->color('info')
                ->url(SchoolClassResource::getUrl('index')),

            Stat::make('Môn học', Subject::count())
                ->icon('heroicon-o-document-text')
                ->color('info')
                ->url(SubjectResource::getUrl('index')),

            Stat::make('Khóa học', AcademicYear::count())
                ->icon('heroicon-o-calendar')
                ->color('info')
                ->url(AcademicYearResource::getUrl('index')),

            Stat::make('Tổng giảng viên', Lecturer::count())
                ->icon('heroicon-o-users')
                ->color('info')
                ->url(LecturerResource::getUrl('index')),

            Stat::make('Tổng sinh viên', Student::count())
                ->icon('heroicon-o-academic-cap')
                ->color('info')
                ->url(StudentResource::getUrl('index')),
        ];
    }
}
