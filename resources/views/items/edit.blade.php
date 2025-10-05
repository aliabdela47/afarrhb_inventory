@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ app()->getLocale() === 'am' ? 'እቃ አርትዕ' : 'Edit Item' }}
        </h1>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">
            {{ app()->getLocale() === 'am' ? 'ተመለስ' : 'Back' }}
        </a>
    </div>

    <!-- Form -->
    <div class="card">
        <form method="POST" action="{{ route('items.update', $item) }}">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Item Code -->
                <div>
                    <label for="code" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'የእቃ ኮድ' : 'Item Code' }} *
                    </label>
                    <input type="text" name="code" id="code" value="{{ old('code', $item->code) }}" required
                           class="form-input @error('code') border-red-500 @enderror">
                    @error('code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Item Name (English) -->
                <div>
                    <label for="name" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'የእቃ ስም (እንግሊዝኛ)' : 'Item Name (English)' }} *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $item->getOriginal('name')) }}" required
                           class="form-input @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Item Name (Amharic) -->
                <div>
                    <label for="name_am" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'የእቃ ስም (አማርኛ)' : 'Item Name (Amharic)' }}
                    </label>
                    <input type="text" name="name_am" id="name_am" value="{{ old('name_am', $item->name_am) }}"
                           class="form-input @error('name_am') border-red-500 @enderror">
                    @error('name_am')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'ምድብ' : 'Category' }} *
                    </label>
                    <select name="category_id" id="category_id" required
                            class="form-select @error('category_id') border-red-500 @enderror">
                        <option value="">{{ app()->getLocale() === 'am' ? 'ምረጥ' : 'Select' }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Unit of Measure -->
                <div>
                    <label for="unit_of_measure" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'የመለኪያ አሃድ' : 'Unit of Measure' }} *
                    </label>
                    <input type="text" name="unit_of_measure" id="unit_of_measure" value="{{ old('unit_of_measure', $item->unit_of_measure) }}" required
                           class="form-input @error('unit_of_measure') border-red-500 @enderror">
                    @error('unit_of_measure')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Unit Price -->
                <div>
                    <label for="unit_price" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'የአሃድ ዋጋ (ብር)' : 'Unit Price (Birr)' }} *
                    </label>
                    <input type="number" name="unit_price" id="unit_price" step="0.01" min="0" value="{{ old('unit_price', $item->unit_price) }}" required
                           class="form-input @error('unit_price') border-red-500 @enderror">
                    @error('unit_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reorder Level -->
                <div>
                    <label for="reorder_level" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'ዝቅተኛ ክምችት ደረጃ' : 'Reorder Level' }} *
                    </label>
                    <input type="number" name="reorder_level" id="reorder_level" min="0" value="{{ old('reorder_level', $item->reorder_level) }}" required
                           class="form-input @error('reorder_level') border-red-500 @enderror">
                    @error('reorder_level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="form-label">
                        {{ app()->getLocale() === 'am' ? 'መግለጫ' : 'Description' }}
                    </label>
                    <textarea name="description" id="description" rows="3"
                              class="form-input @error('description') border-red-500 @enderror">{{ old('description', $item->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('items.index') }}" class="btn btn-secondary">
                    {{ app()->getLocale() === 'am' ? 'ሰርዝ' : 'Cancel' }}
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ app()->getLocale() === 'am' ? 'አስቀምጥ' : 'Update' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
