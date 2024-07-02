<?php

namespace App\Filament\Resources\ShortenerResource\Pages;

use App\Filament\Resources\ShortenerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShortener extends CreateRecord
{
    protected static string $resource = ShortenerResource::class;
}
