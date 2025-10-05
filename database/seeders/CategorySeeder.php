<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Medical Equipment', 'name_am' => 'የህክምና መሳሪያዎች', 'code' => 'CAT-001'],
            ['name' => 'Office Supplies', 'name_am' => 'የቢሮ አቅርቦቶች', 'code' => 'CAT-002'],
            ['name' => 'Furniture', 'name_am' => 'የቤት እቃዎች', 'code' => 'CAT-003'],
            ['name' => 'IT Equipment', 'name_am' => 'የአይቲ መሳሪያዎች', 'code' => 'CAT-004'],
            ['name' => 'Vehicles', 'name_am' => 'ተሽከርካሪዎች', 'code' => 'CAT-005'],
            ['name' => 'Pharmaceuticals', 'name_am' => 'መድሃኒቶች', 'code' => 'CAT-006'],
            ['name' => 'Laboratory Supplies', 'name_am' => 'የላብራቶሪ አቅርቦቶች', 'code' => 'CAT-007'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
