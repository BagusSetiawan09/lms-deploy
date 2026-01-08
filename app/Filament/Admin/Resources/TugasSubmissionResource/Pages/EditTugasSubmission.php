<?php

namespace App\Filament\Admin\Resources\TugasSubmissionResource\Pages;

use App\Filament\Admin\Resources\TugasSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTugasSubmission extends EditRecord
{
    protected static string $resource = TugasSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
