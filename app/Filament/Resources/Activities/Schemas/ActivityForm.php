<?php

namespace App\Filament\Resources\Activities\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("log_name")
                    ->label("Tên Log")
                    ->readOnly(),
                TextInput::make("description")
                    ->label("Mô tả")
                    ->readOnly(),
                TextInput::make("subject_type")
                    ->label("Loại đối tượng")
                    ->readOnly(),
                TextInput::make("event")
                    ->label("Sự kiện")
                    ->readOnly(),
                TextInput::make("subject_id")
                    ->label("ID đối tượng")
                    ->readOnly(),
                TextInput::make("causer_type")
                    ->label("Loại người thực hiện")
                    ->readOnly(),
                TextInput::make("causer_id")
                    ->label("ID người thực hiện")
                    ->readOnly(),
            ]);
    }
}
