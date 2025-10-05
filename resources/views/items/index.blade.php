@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ app()->getLocale() === 'am' ? 'እቃዎች' : 'Items' }}
        </h1>
        @if(auth()->user()->isAdmin() || auth()->user()->isWarehouseManager())
        <a href="{{ route('items.create') }}" class="btn btn-primary">
            {{ app()->getLocale() === 'am' ? 'አዲስ እቃ አክል' : 'Add New Item' }}
        </a>
        @endif
    </div>

    <!-- Items Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ኮድ' : 'Code' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ስም' : 'Name' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ምድብ' : 'Category' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'አሃድ' : 'Unit' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ዋጋ' : 'Price' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ብዛት' : 'Total Qty' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ድርጊቶች' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($items as $item)
                    <tr>
                        <td class="table-cell font-medium">{{ $item->code }}</td>
                        <td class="table-cell">{{ $item->name }}</td>
                        <td class="table-cell">{{ $item->category->name }}</td>
                        <td class="table-cell">{{ $item->unit_of_measure }}</td>
                        <td class="table-cell">{{ number_format($item->unit_price, 2) }}</td>
                        <td class="table-cell">
                            @php
                                $totalQty = $item->inventory->sum('quantity');
                                $isLowStock = $totalQty <= $item->reorder_level;
                            @endphp
                            <span class="{{ $isLowStock ? 'text-red-600 font-semibold' : '' }}">
                                {{ $totalQty }}
                            </span>
                        </td>
                        <td class="table-cell">
                            <div class="flex space-x-2">
                                @if(auth()->user()->isAdmin() || auth()->user()->isWarehouseManager())
                                <a href="{{ route('items.edit', $item) }}" class="text-primary-600 hover:text-primary-900">
                                    {{ app()->getLocale() === 'am' ? 'አርትዕ' : 'Edit' }}
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="table-cell text-center text-gray-500">
                            {{ app()->getLocale() === 'am' ? 'ምንም እቃዎች አልተገኙም' : 'No items found' }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
