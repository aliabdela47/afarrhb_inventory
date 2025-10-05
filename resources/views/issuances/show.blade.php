@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ app()->getLocale() === 'am' ? 'የወጪ ዝርዝር' : 'Issuance Details' }}
        </h1>
        <div class="space-x-2">
            <a href="{{ route('issuances.print', $issuance) }}" target="_blank" class="btn btn-secondary">
                {{ app()->getLocale() === 'am' ? 'አትም' : 'Print' }}
            </a>
            <a href="{{ route('issuances.index') }}" class="btn btn-secondary">
                {{ app()->getLocale() === 'am' ? 'ተመለስ' : 'Back' }}
            </a>
        </div>
    </div>

    <!-- Issuance Information -->
    <div class="card">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">
                    {{ app()->getLocale() === 'am' ? 'ቁጥር' : 'Reference Number' }}
                </h3>
                <p class="text-lg font-semibold">{{ $issuance->reference_number }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">
                    {{ app()->getLocale() === 'am' ? 'አይነት' : 'Type' }}
                </h3>
                <p class="text-lg">
                    <span class="px-3 py-1 text-sm font-semibold rounded 
                        {{ $issuance->type === 'model_19' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                        {{ $issuance->type === 'model_19' ? 'Model-19' : 'Model-22' }}
                    </span>
                </p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">
                    {{ app()->getLocale() === 'am' ? 'መጋዘን' : 'Warehouse' }}
                </h3>
                <p class="text-lg">{{ $issuance->warehouse->name }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">
                    {{ app()->getLocale() === 'am' ? 'ቀን' : 'Issue Date' }}
                </h3>
                <p class="text-lg">{{ $issuance->issue_date->format('Y-m-d') }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">
                    {{ app()->getLocale() === 'am' ? 'ሰራተኛ' : 'Employee' }}
                </h3>
                <p class="text-lg">{{ $issuance->employee->name }}</p>
                <p class="text-sm text-gray-600">{{ $issuance->employee->emp_id }} | {{ $issuance->employee->department }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">
                    {{ app()->getLocale() === 'am' ? 'ሁኔታ' : 'Status' }}
                </h3>
                <p class="text-lg">
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                        @if($issuance->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($issuance->status === 'approved') bg-green-100 text-green-800
                        @elseif($issuance->status === 'issued') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ ucfirst($issuance->status) }}
                    </span>
                </p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1">
                    {{ app()->getLocale() === 'am' ? 'የተከፋፈለው በ' : 'Issued By' }}
                </h3>
                <p class="text-lg">{{ $issuance->issuedBy->name }}</p>
            </div>

            @if($issuance->purpose)
            <div class="md:col-span-2">
                <h3 class="text-sm font-medium text-gray-500 mb-1">
                    {{ app()->getLocale() === 'am' ? 'ዓላማ' : 'Purpose' }}
                </h3>
                <p class="text-lg">{{ $issuance->purpose }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Items -->
    <div class="card">
        <h3 class="text-lg font-semibold mb-4">
            {{ app()->getLocale() === 'am' ? 'እቃዎች' : 'Items' }}
        </h3>
        
        <div class="overflow-x-auto">
            <table class="table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="table-header">#</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'የእቃ ስም' : 'Item Name' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ኮድ' : 'Code' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'የተጠየቀ' : 'Requested' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'የተሰጠ' : 'Issued' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ዋጋ' : 'Unit Price' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ጠቅላላ' : 'Total' }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($issuance->items as $index => $item)
                    <tr>
                        <td class="table-cell">{{ $index + 1 }}</td>
                        <td class="table-cell">{{ $item->item->name }}</td>
                        <td class="table-cell">{{ $item->item->code }}</td>
                        <td class="table-cell text-center">{{ $item->quantity_requested }}</td>
                        <td class="table-cell text-center">{{ $item->quantity_issued ?: '-' }}</td>
                        <td class="table-cell text-right">{{ number_format($item->unit_price, 2) }}</td>
                        <td class="table-cell text-right">{{ number_format($item->getTotalPrice(), 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="bg-gray-50">
                        <td colspan="6" class="table-cell text-right font-semibold">
                            {{ app()->getLocale() === 'am' ? 'ጠቅላላ:' : 'Total:' }}
                        </td>
                        <td class="table-cell text-right font-bold">
                            {{ number_format($issuance->items->sum(function($item) { return $item->getTotalPrice(); }), 2) }}
                            {{ app()->getLocale() === 'am' ? 'ብር' : 'Birr' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
