<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Issuance;
use App\Models\Inventory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stats = [
            'total_items' => Item::where('is_active', true)->count(),
            'low_stock_items' => Inventory::whereHas('item', function($query) {
                $query->where('is_active', true);
            })
            ->whereRaw('quantity <= (SELECT reorder_level FROM items WHERE items.id = inventory.item_id)')
            ->count(),
            'pending_issuances' => Issuance::where('status', 'pending')->count(),
            'today_issuances' => Issuance::whereDate('issue_date', today())->count(),
        ];

        $recent_issuances = Issuance::with(['employee', 'warehouse', 'issuedBy'])
            ->latest()
            ->limit(10)
            ->get();

        $low_stock_items = Inventory::with(['item', 'warehouse'])
            ->whereHas('item', function($query) {
                $query->where('is_active', true);
            })
            ->whereRaw('quantity <= (SELECT reorder_level FROM items WHERE items.id = inventory.item_id)')
            ->limit(10)
            ->get();

        return view('dashboard', compact('stats', 'recent_issuances', 'low_stock_items'));
    }
}
