<?php

namespace App\Filament\Resources\RequestQueueResource\Pages;

use App\Filament\Resources\RequestQueueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRequestQueues extends ListRecords
{
    protected static string $resource = RequestQueueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
