<?php

namespace App\projects\landlord\Filament\Pages;

use Filament\Pages\Page;

class DashboardLandlord extends Page
{
    protected static ?string $slug = 'dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';
}
