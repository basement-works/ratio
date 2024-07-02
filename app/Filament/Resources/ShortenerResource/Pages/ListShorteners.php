<?php

namespace App\Filament\Resources\ShortenerResource\Pages;

use App\Filament\Resources\ShortenerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShorteners extends ListRecords
{
    protected static string $resource = ShortenerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
