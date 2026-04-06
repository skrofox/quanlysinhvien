<?php

namespace App\Filament\Resources\SchoolYears\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SchoolYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin Năm học (School Year)')
                    ->description('Bảng này dùng để quản lý các Năm học (ví dụ: Năm học 2024-2025). Đây là một đơn vị thời gian diễn ra các hoạt động giảng dạy thực tế trong 1 năm học, bao gồm các Học kỳ 1, 2 và Học kỳ hè.')
                    ->schema([
                        TextInput::make('start_year')
                            ->label('Năm bắt đầu')
                            ->helperText('Năm đầu của kỳ học (thường là tháng 8 hoặc tháng 9).')
                            ->required()
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->live(),
                        TextInput::make('end_year')
                            ->label('Năm kết thúc')
                            ->helperText('Năm cuối của kỳ học (thường là tháng 5 hoặc tháng 6 năm sau).')
                            ->required()
                            ->numeric()
                            ->minValue(fn ($get) => $get('start_year') ?: 2000)
                            ->maxValue(2100)
                            ->unique(
                                table: 'school_years',
                                column: 'end_year',
                                ignorable: fn ($record) => $record,
                                modifyRuleUsing: fn ($rule, $get) => $rule->where('start_year', $get('start_year'))
                            )
                            ->validationMessages([
                                'min' => 'Năm kết thúc phải lớn hơn hoặc bằng năm bắt đầu (:min).',
                                'unique' => 'Năm học :start_year - :value đã tồn tại.',
                            ]),
                    ])->columns(2),
            ]);
    }
}
