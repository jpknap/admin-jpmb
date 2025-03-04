<?php

namespace App\Projects\Landlord\Filament\Resources\TenantResource\Pages;

use App\Models\User;
use App\Projects\Landlord\Filament\Resources\TenantResource;
use Filament\Resources\Pages\CreateRecord;
use Stancl\Tenancy\Database\Models\Domain;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;

    protected function afterCreate(): void
    {
        $tenant = $this->record;
        $subdomain = $this->data['domain'];
        Domain::create([
            'domain' => $subdomain,
            'tenant_id' => $tenant->id, // ID del Tenant recién creado
        ]);

        tenancy()->initialize($tenant);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@tenant.com',
        ]);
        tenancy()->end();
    }
}
