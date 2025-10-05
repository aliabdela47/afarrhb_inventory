@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ app()->getLocale() === 'am' ? 'አዲስ ወጪ ይፍጠሩ' : 'Create New Issuance' }}
        </h1>
        <a href="{{ route('issuances.index') }}" class="btn btn-secondary">
            {{ app()->getLocale() === 'am' ? 'ተመለስ' : 'Back' }}
        </a>
    </div>

    <!-- Form -->
    <div class="card">
        <form method="POST" action="{{ route('issuances.store') }}" id="issuanceForm">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Reference Number -->
                <div>
                    <label for="reference_number" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'ቁጥር' : 'Reference Number' }} *
                    </label>
                    <input type="text" name="reference_number" id="reference_number" value="{{ old('reference_number') }}" required
                           class="form-input @error('reference_number') border-red-500 @enderror">
                    @error('reference_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <div>
                    <label for="type" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'አይነት' : 'Type' }} *
                    </label>
                    <select name="type" id="type" required class="form-select @error('type') border-red-500 @enderror">
                        <option value="">{{ app()->getLocale() === 'am' ? 'ምረጥ' : 'Select' }}</option>
                        <option value="model_19" {{ old('type') === 'model_19' ? 'selected' : '' }}>Model-19</option>
                        <option value="model_22" {{ old('type') === 'model_22' ? 'selected' : '' }}>Model-22</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Warehouse -->
                <div>
                    <label for="warehouse_id" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'መጋዘን' : 'Warehouse' }} *
                    </label>
                    <select name="warehouse_id" id="warehouse_id" required class="form-select @error('warehouse_id') border-red-500 @enderror">
                        <option value="">{{ app()->getLocale() === 'am' ? 'ምረጥ' : 'Select' }}</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('warehouse_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Issue Date -->
                <div>
                    <label for="issue_date" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'ቀን' : 'Issue Date' }} *
                    </label>
                    <input type="date" name="issue_date" id="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required
                           class="form-input @error('issue_date') border-red-500 @enderror">
                    @error('issue_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Employee Search -->
            <div class="mb-6">
                <livewire:employees.employee-search />
                <input type="hidden" name="employee_id" id="employee_id" value="{{ old('employee_id') }}">
                @error('employee_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Purpose -->
            <div class="mb-6">
                <label for="purpose" class="form-label">
                    {{ app()->getLocale() === 'am' ? 'ዓላማ' : 'Purpose' }}
                </label>
                <textarea name="purpose" id="purpose" rows="2" class="form-input @error('purpose') border-red-500 @enderror">{{ old('purpose') }}</textarea>
                @error('purpose')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Items Section -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold mb-4">
                    {{ app()->getLocale() === 'am' ? 'እቃዎች' : 'Items' }}
                </h3>

                <div id="items-container">
                    <div class="item-row grid grid-cols-12 gap-4 mb-4">
                        <div class="col-span-6">
                            <label class="form-label">{{ app()->getLocale() === 'am' ? 'እቃ' : 'Item' }} *</label>
                            <select name="items[0][item_id]" required class="form-select">
                                <option value="">{{ app()->getLocale() === 'am' ? 'ምረጥ' : 'Select' }}</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-4">
                            <label class="form-label">{{ app()->getLocale() === 'am' ? 'ብዛት' : 'Quantity' }} *</label>
                            <input type="number" name="items[0][quantity_requested]" min="1" required class="form-input">
                        </div>
                        <div class="col-span-2 flex items-end">
                            <button type="button" onclick="removeItem(this)" class="btn btn-danger w-full">
                                {{ app()->getLocale() === 'am' ? 'ሰርዝ' : 'Remove' }}
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" onclick="addItem()" class="btn btn-secondary mt-2">
                    {{ app()->getLocale() === 'am' ? '+ እቃ አክል' : '+ Add Item' }}
                </button>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('issuances.index') }}" class="btn btn-secondary">
                    {{ app()->getLocale() === 'am' ? 'ሰርዝ' : 'Cancel' }}
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ app()->getLocale() === 'am' ? 'ይፍጠሩ' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let itemIndex = 1;
    
    function addItem() {
        const container = document.getElementById('items-container');
        const newRow = document.createElement('div');
        newRow.className = 'item-row grid grid-cols-12 gap-4 mb-4';
        newRow.innerHTML = `
            <div class="col-span-6">
                <label class="form-label">{{ app()->getLocale() === 'am' ? 'እቃ' : 'Item' }} *</label>
                <select name="items[${itemIndex}][item_id]" required class="form-select">
                    <option value="">{{ app()->getLocale() === 'am' ? 'ምረጥ' : 'Select' }}</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-4">
                <label class="form-label">{{ app()->getLocale() === 'am' ? 'ብዛት' : 'Quantity' }} *</label>
                <input type="number" name="items[${itemIndex}][quantity_requested]" min="1" required class="form-input">
            </div>
            <div class="col-span-2 flex items-end">
                <button type="button" onclick="removeItem(this)" class="btn btn-danger w-full">
                    {{ app()->getLocale() === 'am' ? 'ሰርዝ' : 'Remove' }}
                </button>
            </div>
        `;
        container.appendChild(newRow);
        itemIndex++;
    }
    
    function removeItem(button) {
        const container = document.getElementById('items-container');
        if (container.children.length > 1) {
            button.closest('.item-row').remove();
        } else {
            alert('{{ app()->getLocale() === 'am' ? 'ቢያንስ አንድ እቃ ያስፈልጋል' : 'At least one item is required' }}');
        }
    }
    
    // Listen for employee selection
    window.addEventListener('employee-selected', event => {
        document.getElementById('employee_id').value = event.detail.employeeId;
    });
</script>
@endsection
