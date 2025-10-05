<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Category Filter -->
        <div>
            <label class="form-label">
                {{ app()->getLocale() === 'am' ? 'ምድብ' : 'Category' }}
            </label>
            <select wire:model.live="selectedCategory" class="form-select">
                <option value="">{{ app()->getLocale() === 'am' ? 'ሁሉም ምድቦች' : 'All Categories' }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Search -->
        <div>
            <label class="form-label">
                {{ app()->getLocale() === 'am' ? 'ፈልግ' : 'Search' }}
            </label>
            <input type="text" wire:model.live="search" class="form-input" 
                   placeholder="{{ app()->getLocale() === 'am' ? 'የእቃ ስም ወይም ኮድ ያስገቡ' : 'Enter item name or code' }}">
        </div>
    </div>

    <!-- Items List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($items as $item)
            <div wire:click="selectItem({{ $item->id }})" 
                 class="p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition {{ $selectedItem == $item->id ? 'border-primary-500 bg-primary-50' : 'border-gray-200' }}">
                <h4 class="font-semibold text-gray-900">{{ $item->name }}</h4>
                <p class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'ኮድ' : 'Code' }}: {{ $item->code }}</p>
                <p class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'ምድብ' : 'Category' }}: {{ $item->category->name }}</p>
                <p class="text-sm text-primary-600 font-semibold">
                    {{ app()->getLocale() === 'am' ? 'ዋጋ' : 'Price' }}: {{ number_format($item->unit_price, 2) }} {{ app()->getLocale() === 'am' ? 'ብር' : 'Birr' }}
                </p>
            </div>
        @empty
            <div class="col-span-full text-center py-8 text-gray-500">
                {{ app()->getLocale() === 'am' ? 'ምንም እቃ አልተገኘም' : 'No items found' }}
            </div>
        @endforelse
    </div>
</div>
