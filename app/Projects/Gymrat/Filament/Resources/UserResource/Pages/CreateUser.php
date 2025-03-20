<?php

namespace App\projects\base\Filament\Resources\UserResource\Pages;

use App\projects\base\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
