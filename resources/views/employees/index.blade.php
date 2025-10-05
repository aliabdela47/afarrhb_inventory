@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ app()->getLocale() === 'am' ? 'ሰራተኞች' : 'Employees' }}
        </h1>
    </div>

    <!-- Employees Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'መታወቂያ' : 'ID' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ስም' : 'Name' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ክፍል' : 'Department' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'የስራ መደብ' : 'Position' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ስልክ' : 'Phone' }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($employees as $employee)
                    <tr>
                        <td class="table-cell font-medium">{{ $employee->emp_id }}</td>
                        <td class="table-cell">{{ $employee->name }}</td>
                        <td class="table-cell">{{ $employee->department }}</td>
                        <td class="table-cell">{{ $employee->position }}</td>
                        <td class="table-cell">{{ $employee->phone }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="table-cell text-center text-gray-500">
                            {{ app()->getLocale() === 'am' ? 'ምንም ሰራተኞች አልተገኙም' : 'No employees found' }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection
