<?php

namespace App\Http\Controllers;

use App\Models\Issuance;
use App\Models\Warehouse;
use App\Models\Employee;
use App\Models\Item;
use Illuminate\Http\Request;

class IssuanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $issuances = Issuance::with(['employee', 'warehouse', 'issuedBy'])
            ->latest()
            ->paginate(15);

        return view('issuances.index', compact('issuances'));
    }

    public function create()
    {
        $warehouses = Warehouse::where('is_active', true)->get();
        $items = Item::where('is_active', true)->get();
        
        return view('issuances.create', compact('warehouses', 'items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference_number' => 'required|string|unique:issuances,reference_number',
            'type' => 'required|in:model_19,model_22',
            'warehouse_id' => 'required|exists:warehouses,id',
            'employee_id' => 'required|exists:emp_list,id',
            'issue_date' => 'required|date',
            'purpose' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity_requested' => 'required|integer|min:1',
        ]);

        $issuance = Issuance::create([
            'reference_number' => $validated['reference_number'],
            'type' => $validated['type'],
            'warehouse_id' => $validated['warehouse_id'],
            'employee_id' => $validated['employee_id'],
            'issued_by' => auth()->id(),
            'issue_date' => $validated['issue_date'],
            'purpose' => $validated['purpose'] ?? null,
            'status' => 'pending',
        ]);

        foreach ($validated['items'] as $itemData) {
            $item = Item::find($itemData['item_id']);
            $issuance->items()->create([
                'item_id' => $itemData['item_id'],
                'quantity_requested' => $itemData['quantity_requested'],
                'unit_price' => $item->unit_price,
            ]);
        }

        return redirect()->route('issuances.show', $issuance)
            ->with('success', 'Issuance created successfully.');
    }

    public function show(Issuance $issuance)
    {
        $issuance->load(['employee', 'warehouse', 'issuedBy', 'items.item']);
        
        return view('issuances.show', compact('issuance'));
    }

    public function print(Issuance $issuance)
    {
        $issuance->load(['employee', 'warehouse', 'issuedBy', 'items.item']);
        
        return view('issuances.print', compact('issuance'));
    }
}
