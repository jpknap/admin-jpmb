<?php

namespace App\Providers\Filament;

use App\Http\Middleware\InitializeTenancyPanel;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    const LANDLORD_PANEL = 'landlord';

    const TENANT_PANEL = 'tenant';

    public function register(): void
    {
        Filament::registerPanel(
            fn (): Panel => $this->panel(Panel::make(), isLandlord: false),
        );
        Filament::registerPanel(
            fn (): Panel => $this->panel(Panel::make()),
        );
    }

    public function panel(Panel $panel, bool $isLandlord = true): Panel
    {
        $panel
            ->default()
            ->id($isLandlord ? self::LANDLORD_PANEL : self::TENANT_PANEL)
            ->path($isLandlord ? 'admin' : '')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                InitializeTenancyPanel::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
        if ($isLandlord) {
            $panel->discoverPages(in: app_path('Filament/Pages/landlord'), for: 'App\\Filament\\Pages\\landlord');
            $panel->discoverResources(in: app_path('Filament/Resources/landlord'), for: 'App\\Filament\\Resources\\landlord');
        }
        else {
            $panel->discoverPages(in: app_path('Filament/Pages/tenants'), for: 'App\\Filament\\Pages\\tenants');
            $panel->discoverResources(in: app_path('Filament/Resources/tenants'), for: 'App\\Filament\\Resources\\tenants');
        }

        return $panel;
    }

}
