@extends('layouts.app')

@section('content')
<div class="text-center py-16">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">
        {{ app()->getLocale() === 'am' ? 'እንኳን ወደ የአፋር ክልል ጤና ቢሮ የእቃ ዝርዝር አስተዳደር ስርዓት በደህና መጡ' : 'Welcome to AfarRHB Inventory Management System' }}
    </h1>
    
    <p class="text-xl text-gray-600 mb-8">
        {{ app()->getLocale() === 'am' ? 'የእቃ፣ የእቃ ወጪ እና የኦዲት ሎግ አስተዳደር' : 'Inventory, Item Issuance, and Audit Log Management' }}
    </p>

    <div class="space-x-4">
        @guest
            <a href="/login" class="btn btn-primary">
                {{ app()->getLocale() === 'am' ? 'ግባ' : 'Login' }}
            </a>
        @else
            <a href="/dashboard" class="btn btn-primary">
                {{ app()->getLocale() === 'am' ? 'ወደ ዳሽቦርድ ይሂዱ' : 'Go to Dashboard' }}
            </a>
        @endguest
    </div>

    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
        <div class="card">
            <div class="text-primary-600 text-4xl mb-4">📦</div>
            <h3 class="text-lg font-semibold mb-2">
                {{ app()->getLocale() === 'am' ? 'የእቃ አስተዳደር' : 'Inventory Management' }}
            </h3>
            <p class="text-gray-600">
                {{ app()->getLocale() === 'am' ? 'በሁለት መጋዘኖች መካከል እቃዎችን ይከታተሉ' : 'Track items across two warehouses' }}
            </p>
        </div>

        <div class="card">
            <div class="text-primary-600 text-4xl mb-4">📋</div>
            <h3 class="text-lg font-semibold mb-2">
                {{ app()->getLocale() === 'am' ? 'ሞዴል-19/22' : 'Model-19/22' }}
            </h3>
            <p class="text-gray-600">
                {{ app()->getLocale() === 'am' ? 'የእቃ ወጪዎችን ያስተዳድሩ' : 'Manage item issuances' }}
            </p>
        </div>

        <div class="card">
            <div class="text-primary-600 text-4xl mb-4">📊</div>
            <h3 class="text-lg font-semibold mb-2">
                {{ app()->getLocale() === 'am' ? 'ኦዲት ሎግ' : 'Audit Logs' }}
            </h3>
            <p class="text-gray-600">
                {{ app()->getLocale() === 'am' ? 'ሁሉንም ለውጦች ይከታተሉ' : 'Track all changes' }}
            </p>
        </div>
    </div>
</div>
@endsection
