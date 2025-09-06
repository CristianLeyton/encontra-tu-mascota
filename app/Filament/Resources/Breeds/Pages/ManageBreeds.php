<?php

namespace App\Filament\Resources\Breeds\Pages;

use App\Filament\Resources\Breeds\BreedsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageBreeds extends ManageRecords
{
    protected static string $resource = BreedsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
