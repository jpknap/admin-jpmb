<?php

declare(strict_types=1);

namespace App\Http\Middleware;


use App\Models\Tenant;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Support\Str;

class InitializeTenancyPanel
{
    public function handle($request, Closure $next): mixed
    {
        $tenant = tenancy()->tenant;
        if (!$tenant) {
            $panel = Filament::getPanel('landlord');
        } else {
            $panel = Filament::getPanel('tenant');
        }
        Filament::setCurrentPanel($panel);

        return $next($request);

    }
}
