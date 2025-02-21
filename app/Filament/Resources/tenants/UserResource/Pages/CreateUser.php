<?php

namespace App\Filament\Resources\tenants\UserResource\Pages;

use App\Filament\Resources\tenants\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
