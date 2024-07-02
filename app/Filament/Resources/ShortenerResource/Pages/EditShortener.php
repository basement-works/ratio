<?php

namespace App\Filament\Resources\ShortenerResource\Pages;

use App\Filament\Resources\ShortenerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShortener extends EditRecord
{
    protected static string $resource = ShortenerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
