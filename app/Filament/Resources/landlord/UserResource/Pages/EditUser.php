<?php

namespace App\Filament\Resources\landlord\UserResource\Pages;

use App\Filament\Resources\common\UserResourceCommon;
use App\Filament\Resources\landlord\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
