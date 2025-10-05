<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use App\Models\User;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        $manager = User::where('role', 'warehouse_manager')->first();

        Warehouse::create([
            'name' => 'Central Warehouse',
            'name_am' => 'ማዕከላዊ መጋዘን',
            'code' => 'WH-001',
            'location' => 'Semera, Afar Region',
            'manager_id' => $manager?->id,
            'is_active' => true,
        ]);

        Warehouse::create([
            'name' => 'Regional Warehouse',
            'name_am' => 'ክልላዊ መጋዘን',
            'code' => 'WH-002',
            'location' => 'Dubti, Afar Region',
            'manager_id' => $manager?->id,
            'is_active' => true,
        ]);
    }
}
