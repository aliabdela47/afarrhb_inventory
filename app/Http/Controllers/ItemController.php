<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Item::with(['category', 'inventory.warehouse'])
            ->where('is_active', true)
            ->paginate(15);

        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_am' => 'nullable|string|max:255',
            'code' => 'required|string|unique:items,code',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'unit_of_measure' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'reorder_level' => 'required|integer|min:0',
        ]);

        Item::create($validated);

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully.');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_am' => 'nullable|string|max:255',
            'code' => 'required|string|unique:items,code,' . $item->id,
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'unit_of_measure' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'reorder_level' => 'required|integer|min:0',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully.');
    }
}
