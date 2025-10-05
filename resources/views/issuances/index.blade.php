@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ app()->getLocale() === 'am' ? 'ወጪዎች' : 'Issuances' }}
        </h1>
        @if(auth()->user()->isAdmin() || auth()->user()->isWarehouseManager())
        <a href="{{ route('issuances.create') }}" class="btn btn-primary">
            {{ app()->getLocale() === 'am' ? 'አዲስ ወጪ ይፍጠሩ' : 'Create New Issuance' }}
        </a>
        @endif
    </div>

    <!-- Issuances Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ቁጥር' : 'Reference #' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'አይነት' : 'Type' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ሰራተኛ' : 'Employee' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'መጋዘን' : 'Warehouse' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ቀን' : 'Date' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ሁኔታ' : 'Status' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ድርጊቶች' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($issuances as $issuance)
                    <tr>
                        <td class="table-cell font-medium">{{ $issuance->reference_number }}</td>
                        <td class="table-cell">
                            <span class="px-2 py-1 text-xs font-semibold rounded 
                                {{ $issuance->type === 'model_19' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                {{ $issuance->type === 'model_19' ? 'Model-19' : 'Model-22' }}
                            </span>
                        </td>
                        <td class="table-cell">{{ $issuance->employee->name }}</td>
                        <td class="table-cell">{{ $issuance->warehouse->name }}</td>
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
                        <td class="table-cell">
                            <div class="flex space-x-2">
                                <a href="{{ route('issuances.show', $issuance) }}" class="text-primary-600 hover:text-primary-900">
                                    {{ app()->getLocale() === 'am' ? 'ይመልከቱ' : 'View' }}
                                </a>
                                <a href="{{ route('issuances.print', $issuance) }}" target="_blank" class="text-green-600 hover:text-green-900">
                                    {{ app()->getLocale() === 'am' ? 'አትም' : 'Print' }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="table-cell text-center text-gray-500">
                            {{ app()->getLocale() === 'am' ? 'ምንም ወጪዎች አልተገኙም' : 'No issuances found' }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $issuances->links() }}
        </div>
    </div>
</div>
@endsection
