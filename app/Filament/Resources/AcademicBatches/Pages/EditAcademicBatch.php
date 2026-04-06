<?php

namespace App\Filament\Resources\AcademicBatches\Pages;

use App\Filament\Resources\AcademicBatches\AcademicBatchResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAcademicBatch extends EditRecord
{
    protected static string $resource = AcademicBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
