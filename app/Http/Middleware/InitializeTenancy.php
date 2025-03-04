<?php

declare(strict_types=1);

namespace App\Http\Middleware;


use App\Models\Tenant;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Support\Str;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;

class InitializeTenancy extends InitializeTenancyByDomainOrSubdomain
{
    public function handle($request, Closure $next)
    {
        if (in_array(request()->getHost(), config('tenancy.central_domains'))) {
            return $next($request);
        }
        return parent::handle($request, $next);
    }
}
