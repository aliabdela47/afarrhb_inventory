<?php

namespace App\Livewire\Dashboard;

use App\Models\Item;
use App\Models\Issuance;
use App\Models\Inventory;
use Livewire\Component;

class StatsWidget extends Component
{
    public $totalItems;
    public $lowStockItems;
    public $pendingIssuances;
    public $todayIssuances;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->totalItems = Item::where('is_active', true)->count();
        
        $this->lowStockItems = Inventory::whereHas('item', function($query) {
            $query->where('is_active', true);
        })
        ->whereRaw('quantity <= (SELECT reorder_level FROM items WHERE items.id = inventory.item_id)')
        ->count();
        
        $this->pendingIssuances = Issuance::where('status', 'pending')->count();
        
        $this->todayIssuances = Issuance::whereDate('issue_date', today())->count();
    }

    public function render()
    {
        return view('livewire.dashboard.stats-widget');
    }
}
