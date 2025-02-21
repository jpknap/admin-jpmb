<?php

namespace App\Filament\Pages\tenants;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $slug = 'dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';
}
