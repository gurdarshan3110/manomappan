<?php

namespace App\Filament\Resources\CareerClusterResource\Pages;

use App\Filament\Resources\CareerClusterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCareerCluster extends EditRecord
{
    protected static string $resource = CareerClusterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
