<?php

namespace App\Providers\Filament;

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
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;

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
            ->path($isLandlord ? 'admin' : 'tenant')
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
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
        if ($isLandlord) {
            $panel->discoverPages(in: app_path('Projects/Landlord/Filament/Pages'), for: 'App\\Projects\\Landlord\\Filament\\Pages');
            $panel->discoverResources(in: app_path('Projects/Landlord/Filament/Resources'), for: 'App\\Projects\\Landlord\\Filament\\Resources');
        }
        else {
            $panel->discoverPages(in: app_path('Projects/Base/Filament/Pages'), for: 'App\\Projects\\Base\\Filament\\Pages');
            $panel->discoverResources(in: app_path('Projects/Base/Filament/Resources'), for: 'App\\Projects\\Base\\Filament\\Resources');
        }

        return $panel;
    }

}
