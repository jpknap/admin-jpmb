<?php

namespace App\Filament\Resources\landlord\UserResource\Pages;

use App\Filament\Resources\common\UserResourceCommon;
use App\Filament\Resources\landlord\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
