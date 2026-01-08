<?php

namespace App\Filament\Admin\Resources\PembimbingResource\Pages;

use App\Filament\Admin\Resources\PembimbingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPembimbing extends EditRecord
{
    protected static string $resource = PembimbingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
