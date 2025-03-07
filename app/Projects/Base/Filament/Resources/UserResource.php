<?php

namespace App\projects\base\Filament\Resources;

use App\Filament\Resources\common\UserResourceCommon;
use App\projects\base\Filament\Resources\UserResource\Pages\CreateUser;
use App\projects\base\Filament\Resources\UserResource\Pages\EditUser;
use App\projects\base\Filament\Resources\UserResource\Pages\ListUsers;

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
