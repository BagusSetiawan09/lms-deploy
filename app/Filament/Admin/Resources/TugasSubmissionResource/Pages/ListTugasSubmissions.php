<?php

namespace App\Filament\Admin\Resources\TugasSubmissionResource\Pages;

use App\Filament\Admin\Resources\TugasSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTugasSubmissions extends ListRecords
{
    protected static string $resource = TugasSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
           
        ];
    }
}
