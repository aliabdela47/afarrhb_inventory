@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ app()->getLocale() === 'am' ? 'ዳሽቦርድ' : 'Dashboard' }}
        </h1>
        <p class="text-gray-600">
            {{ app()->getLocale() === 'am' ? 'እንኳን ደህና መጡ' : 'Welcome' }}, {{ auth()->user()->name }}
        </p>
    </div>

    <!-- Stats Widget -->
    <livewire:dashboard.stats-widget />

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Issuances -->
        <div class="card">
            <h3 class="text-lg font-semibold mb-4">
                {{ app()->getLocale() === 'am' ? 'የቅርብ ጊዜ ወጪዎች' : 'Recent Issuances' }}
            </h3>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="table-header">{{ app()->getLocale() === 'am' ? 'ቁጥር' : 'Ref #' }}</th>
                            <th class="table-header">{{ app()->getLocale() === 'am' ? 'ሰራተኛ' : 'Employee' }}</th>
                            <th class="table-header">{{ app()->getLocale() === 'am' ? 'ቀን' : 'Date' }}</th>
                            <th class="table-header">{{ app()->getLocale() === 'am' ? 'ሁኔታ' : 'Status' }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recent_issuances as $issuance)
                        <tr>
                            <td class="table-cell">
                                <a href="{{ route('issuances.show', $issuance) }}" class="text-primary-600 hover:text-primary-900">
                                    {{ $issuance->reference_number }}
                                </a>
                            </td>
                            <td class="table-cell">{{ $issuance->employee->name }}</td>
                            <td class="table-cell">{{ $issuance->issue_date->format('Y-m-d') }}</td>
                            <td class="table-cell">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($issuance->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($issuance->status === 'approved') bg-green-100 text-green-800
                                    @elseif($issuance->status === 'issued') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($issuance->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="table-cell text-center text-gray-500">
                                {{ app()->getLocale() === 'am' ? 'ምንም ወጪዎች የሉም' : 'No issuances found' }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Low Stock Items -->
        <div class="card">
            <h3 class="text-lg font-semibold mb-4 text-red-600">
                {{ app()->getLocale() === 'am' ? 'ዝቅተኛ ክምችት ያላቸው እቃዎች' : 'Low Stock Items' }}
            </h3>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="table-header">{{ app()->getLocale() === 'am' ? 'እቃ' : 'Item' }}</th>
                            <th class="table-header">{{ app()->getLocale() === 'am' ? 'መጋዘን' : 'Warehouse' }}</th>
                            <th class="table-header">{{ app()->getLocale() === 'am' ? 'ብዛት' : 'Qty' }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($low_stock_items as $inventory)
                        <tr>
                            <td class="table-cell">{{ $inventory->item->name }}</td>
                            <td class="table-cell">{{ $inventory->warehouse->name }}</td>
                            <td class="table-cell">
                                <span class="text-red-600 font-semibold">{{ $inventory->quantity }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="table-cell text-center text-gray-500">
                                {{ app()->getLocale() === 'am' ? 'ሁሉም እቃዎች በቂ ክምችት አላቸው' : 'All items have sufficient stock' }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <h3 class="text-lg font-semibold mb-4">
            {{ app()->getLocale() === 'am' ? 'ፈጣን ድርጊቶች' : 'Quick Actions' }}
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('issuances.create') }}" class="btn btn-primary text-center">
                {{ app()->getLocale() === 'am' ? 'አዲስ ወጪ ይፍጠሩ' : 'Create New Issuance' }}
            </a>
            <a href="{{ route('items.index') }}" class="btn btn-secondary text-center">
                {{ app()->getLocale() === 'am' ? 'እቃዎችን ይመልከቱ' : 'View Items' }}
            </a>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary text-center">
                {{ app()->getLocale() === 'am' ? 'ሰራተኞች' : 'Employees' }}
            </a>
        </div>
    </div>
</div>
@endsection
