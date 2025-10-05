<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $warehouses = Warehouse::all();

        $items = [
            ['name' => 'Stethoscope', 'name_am' => 'ስቴቶስኮፕ', 'code' => 'ITM-001', 'unit_of_measure' => 'pcs', 'unit_price' => 1500.00],
            ['name' => 'Blood Pressure Monitor', 'name_am' => 'የደም ግፊት መለኪያ', 'code' => 'ITM-002', 'unit_of_measure' => 'pcs', 'unit_price' => 2500.00],
            ['name' => 'Desk', 'name_am' => 'ጠረጴዛ', 'code' => 'ITM-003', 'unit_of_measure' => 'pcs', 'unit_price' => 3000.00],
            ['name' => 'Office Chair', 'name_am' => 'የቢሮ ወንበር', 'code' => 'ITM-004', 'unit_of_measure' => 'pcs', 'unit_price' => 2000.00],
            ['name' => 'Laptop', 'name_am' => 'ላፕቶፕ', 'code' => 'ITM-005', 'unit_of_measure' => 'pcs', 'unit_price' => 35000.00],
            ['name' => 'Printer', 'name_am' => 'ማተሚያ', 'code' => 'ITM-006', 'unit_of_measure' => 'pcs', 'unit_price' => 5000.00],
            ['name' => 'Paracetamol 500mg', 'name_am' => 'ፓራሴታሞል 500ሚግ', 'code' => 'ITM-007', 'unit_of_measure' => 'box', 'unit_price' => 50.00],
            ['name' => 'Surgical Gloves', 'name_am' => 'የቀዶ ጥገና ጓንቶች', 'code' => 'ITM-008', 'unit_of_measure' => 'box', 'unit_price' => 200.00],
            ['name' => 'Microscope', 'name_am' => 'ማይክሮስኮፕ', 'code' => 'ITM-009', 'unit_of_measure' => 'pcs', 'unit_price' => 15000.00],
            ['name' => 'Test Tubes', 'name_am' => 'የሙከራ ቱቦዎች', 'code' => 'ITM-010', 'unit_of_measure' => 'box', 'unit_price' => 150.00],
        ];

        foreach ($items as $index => $itemData) {
            $category = $categories[$index % $categories->count()];
            
            $item = Item::create([
                'name' => $itemData['name'],
                'name_am' => $itemData['name_am'],
                'code' => $itemData['code'],
                'category_id' => $category->id,
                'description' => 'Sample item description',
                'unit_of_measure' => $itemData['unit_of_measure'],
                'unit_price' => $itemData['unit_price'],
                'reorder_level' => 10,
                'is_active' => true,
            ]);

            // Add inventory for each warehouse
            foreach ($warehouses as $warehouse) {
                Inventory::create([
                    'item_id' => $item->id,
                    'warehouse_id' => $warehouse->id,
                    'quantity' => rand(5, 50),
                    'reserved_quantity' => 0,
                ]);
            }
        }
    }
}
