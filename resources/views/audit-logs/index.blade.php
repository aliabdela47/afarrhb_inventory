@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ app()->getLocale() === 'am' ? 'ኦዲት ሎግ' : 'Audit Logs' }}
        </h1>
    </div>

    <!-- Audit Logs Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ቀን/ሰዓት' : 'Date/Time' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ተጠቃሚ' : 'User' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ድርጊት' : 'Action' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'ሞዴል' : 'Model' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'መታወቂያ' : 'Model ID' }}</th>
                        <th class="table-header">{{ app()->getLocale() === 'am' ? 'IP' : 'IP Address' }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($logs as $log)
                    <tr>
                        <td class="table-cell">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        <td class="table-cell">{{ $log->user ? $log->user->name : 'System' }}</td>
                        <td class="table-cell">
                            <span class="px-2 py-1 text-xs font-semibold rounded
                                @if($log->action === 'created') bg-green-100 text-green-800
                                @elseif($log->action === 'updated') bg-blue-100 text-blue-800
                                @elseif($log->action === 'deleted') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($log->action) }}
                            </span>
                        </td>
                        <td class="table-cell">{{ class_basename($log->model_type) }}</td>
                        <td class="table-cell">{{ $log->model_id }}</td>
                        <td class="table-cell">{{ $log->ip_address }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="table-cell text-center text-gray-500">
                            {{ app()->getLocale() === 'am' ? 'ምንም ሎግ አልተገኘም' : 'No logs found' }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
