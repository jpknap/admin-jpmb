<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            ['id' => 'demo3', 'domain' => 'demo3'],
            ['id' => 'demo4', 'domain' => 'demo4'],
        ];

        foreach ($tenants as $tenantData) {
            $tenant = Tenant::create([
                'id' => $tenantData['id'],
            ]);

            $tenant->domains()->create([
                'domain' => $tenantData['domain'],
            ]);

            tenancy()->initialize($tenant);

            Artisan::call('tenants:migrate');

            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
            tenancy()->end();
        }
    }
}
