<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin Lịch học (Schedule)')
                    ->description('Quản lý thời khóa biểu cho từng lớp học phần.')
                    ->schema([
                        Select::make('course_module_id')
                            ->label('Lớp học phần')
                            ->relationship('courseModule', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->subject->subject_name} - {$record->semester->semester_name} ({$record->semester->schoolYear->start_year} - {$record->semester->schoolYear->end_year}) - {$record->lecturer->full_name}")
                            ->required()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ]),

                Section::make('Tạo nhanh thời khóa biểu')
                    ->description('Chọn ngày, nhập thời gian, phòng học rồi nhấn nút Áp dụng để điền nhanh thay vì phải tự gõ từng ngày.')
                    ->schema([
                        Select::make('quick_days')
                            ->label('Ngày học')
                            ->multiple()
                            ->options([
                                'monday' => 'Thứ 2',
                                'tuesday' => 'Thứ 3',
                                'wednesday' => 'Thứ 4',
                                'thursday' => 'Thứ 5',
                                'friday' => 'Thứ 6',
                                'saturday' => 'Thứ 7',
                            ])
                            ->dehydrated(false),
                        TextInput::make('quick_time')
                            ->label('Ca học / Thời gian')
                            ->placeholder('Ca 1 (07:00 - 09:30)')
                            ->dehydrated(false),
                        TextInput::make('quick_room')
                            ->label('Phòng học')
                            ->placeholder('Phòng A101')
                            ->dehydrated(false),
                        \Filament\Forms\Components\Placeholder::make('quick_fill_btn')
                            ->label('')
                            ->content(new \Illuminate\Support\HtmlString('
                                <button type="button"
                                    x-on:click="
                                        let days = $wire.data.quick_days || [];
                                        let time = $wire.data.quick_time || \'\';
                                        let room = $wire.data.quick_room || \'\';
                                        let text = [time, room].filter(Boolean).join(\', \');
                                        if(text && days.length) {
                                            days.forEach(day => {
                                                $wire.set(\'data.\' + day, text);
                                            });
                                            $wire.set(\'data.quick_days\', []);
                                        }
                                    "
                                    style="background-color: #10b981; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: bold; cursor: pointer; border: none; margin-top: 1.75rem;"
                                >
                                    ⚡ Áp dụng vào các ô bên dưới
                                </button>
                            '))
                            ->columnSpanFull(),
                    ])->columns(3),

                Section::make('Lịch chi tiết theo ngày')
                    ->schema([

                        TextInput::make('monday')
                            ->label('Thứ 2')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                        TextInput::make('tuesday')
                            ->label('Thứ 3')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                        TextInput::make('wednesday')
                            ->label('Thứ 4')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                        TextInput::make('thursday')
                            ->label('Thứ 5')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                        TextInput::make('friday')
                            ->label('Thứ 6')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                        TextInput::make('saturday')
                            ->label('Thứ 7')
                            ->placeholder('Ví dụ: 07:00 - 09:00, Phòng A101')
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}
