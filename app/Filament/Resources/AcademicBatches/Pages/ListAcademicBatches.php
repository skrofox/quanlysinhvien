<?php

namespace App\Filament\Resources\AcademicBatches\Pages;

use App\Filament\Resources\AcademicBatches\AcademicBatchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAcademicBatches extends ListRecords
{
    protected static string $resource = AcademicBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
