<?php

namespace App\Filament\Resources\RequestQueueResource\Pages;

use App\Filament\Resources\RequestQueueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestQueue extends EditRecord
{
    protected static string $resource = RequestQueueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
