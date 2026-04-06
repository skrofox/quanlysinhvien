<?php

namespace App\Filament\Resources\AcademicBatches\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class AcademicBatchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin Khóa học (Academic Batch)')
                    ->description('Bảng này dùng để quản lý các Khóa học (ví dụ: Khóa 2022-2026). Một khóa học đại diện cho một đợt sinh viên nhập học và dự kiến tốt nghiệp cùng nhau. Nó kéo dài trong suốt quá trình đào tạo của một lớp sinh viên.')
                    ->schema([
                        TextInput::make('start_year')
                            ->label("Năm nhập học (Bắt đầu)")
                            ->helperText('Năm mà khóa học này bắt đầu nhập học.')
                            ->numeric()
                            ->maxLength(4)
                            ->rules(['required', 'digits:4'])
                            ->minValue(1900)
                            ->maxValue(2100)
                            ->live()
                            ->required(),
                        TextInput::make('end_year')
                            ->label("Năm tốt nghiệp (Kết thúc)")
                            ->helperText('Năm dự kiến mà khóa học này sẽ tốt nghiệp.')
                            ->numeric()
                            ->maxLength(4)
                            ->rules(['required', 'digits:4'])
                            ->minValue(fn ($get) => $get('start_year'))
                            ->validationMessages([
                                'min' => 'Năm kết thúc phải lớn hơn hoặc bằng năm nhập học (:min).',
                            ])
                            ->unique(
                                table: 'academic_batches',
                                column: 'end_year',
                                ignorable: fn ($record) => $record,
                                modifyRuleUsing: fn ($rule, $get) => $rule->where('start_year', $get('start_year'))
                            )
                            ->validationMessages([
                                'unique' => 'Niên khóa này (từ :start_year - :value) đã tồn tại trong hệ thống.',
                            ])
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
