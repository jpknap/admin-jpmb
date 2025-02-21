<?php

namespace App\Filament\Resources\tenants;

use App\Filament\Resources\common\UserResourceCommon;
use App\Filament\Resources\tenants\UserResource\Pages\EditUser;
use App\Filament\Resources\tenants\UserResource\Pages\CreateUser;
use App\Filament\Resources\tenants\UserResource\Pages\ListUsers;

class UserResource extends UserResourceCommon
{

    protected static ?string $slug = 'users';

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
