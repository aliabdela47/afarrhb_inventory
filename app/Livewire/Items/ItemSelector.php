<?php

namespace App\Livewire\Items;

use App\Models\Item;
use App\Models\Category;
use Livewire\Component;

class ItemSelector extends Component
{
    public $selectedCategory = '';
    public $selectedItem = '';
    public $search = '';
    public $items = [];

    public function mount()
    {
        $this->loadItems();
    }

    public function updatedSelectedCategory()
    {
        $this->loadItems();
        $this->selectedItem = '';
    }

    public function updatedSearch()
    {
        $this->loadItems();
    }

    public function loadItems()
    {
        $query = Item::query()->where('is_active', true);

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('code', 'like', '%' . $this->search . '%');
            });
        }

        $this->items = $query->with('category')->get();
    }

    public function selectItem($itemId)
    {
        $this->selectedItem = $itemId;
        $this->dispatch('item-selected', itemId: $itemId);
    }

    public function render()
    {
        $categories = Category::all();
        
        return view('livewire.items.item-selector', [
            'categories' => $categories,
        ]);
    }
}
