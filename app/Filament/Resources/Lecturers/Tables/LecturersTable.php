<?php

namespace App\Filament\Resources\Lecturers\Tables;
use App\Models\User;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LecturersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lecturer_code')
                    ->label('Mã giảng viên')
                    ->searchable(),
                TextColumn::make('full_name')
                ->label('Họ tên')
                    ->searchable(),
                TextColumn::make('user_id')
    ->label('Tài khoản')
    ->formatStateUsing(fn ($state) => $state ? 'Đã cấp' : 'Chưa cấp')
    ->badge()
    ->color(fn ($state) => $state ? 'success' : 'danger'),
                // TextColumn::make('birthday')
                //     ->date()
                //     ->sortable(),
                TextColumn::make('gender')
                    ->badge(),
                // TextColumn::make('phone')
                //     ->searchable(),
                TextColumn::make('department.department_name')
                    ->label('Khoa')
                    ->searchable(),
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

    Action::make('createAccount')
        ->label('Cấp tài khoản')
        ->icon('heroicon-o-key')
        ->color('success')

        ->visible(fn ($record) => $record->user_id === null)

        ->requiresConfirmation()

        ->action(function ($record) {

            $email = strtolower($record->lecturer_code) . '@school.com';

            $existingUser = User::where('email', $email)->first();

            if ($existingUser) {
                return;
            }

            $user = User::create([
                'name' => $record->full_name,

                'email' => $email,

                'password' => Hash::make('123456'),
            ]);

            $user->assignRole('giang_vien');

            $record->update([
                'user_id' => $user->id,
            ]);
        }),

])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
