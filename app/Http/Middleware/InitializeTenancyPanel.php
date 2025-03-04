<?php

declare(strict_types=1);

namespace App\Http\Middleware;


use App\Models\Tenant;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class InitializeTenancyPanel
{
    public function handle($request, Closure $next): mixed
    {
        $tenant = tenancy()->tenant;
        $path = $request->path();

        $this->validateRouteAccess($tenant, $path);

        return $next($request);

    }

    private function validateRouteAccess($tenant, $path): void
    {
        if ($tenant === null) {
            if (str_starts_with($path, 'tenant') ) {
                throw new NotFoundHttpException('');
            }
        } else {
            if (str_starts_with($path, 'admin')) {
                throw new NotFoundHttpException('');
            }
        }
    }
}
