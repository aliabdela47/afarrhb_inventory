<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'am' ? 'ltr' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AfarRHB Inventory') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg print:hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/" class="text-2xl font-bold text-primary-600">
                                {{ app()->getLocale() === 'am' ? 'የአፋር ክልል ጤና ቢሮ' : 'AfarRHB Inventory' }}
                            </a>
                        </div>
                        
                        <!-- Navigation Links -->
                        @auth
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="/dashboard" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                {{ app()->getLocale() === 'am' ? 'ዳሽቦርድ' : 'Dashboard' }}
                            </a>
                            <a href="/items" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                {{ app()->getLocale() === 'am' ? 'እቃዎች' : 'Items' }}
                            </a>
                            <a href="/issuances" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                {{ app()->getLocale() === 'am' ? 'ወጪዎች' : 'Issuances' }}
                            </a>
                            <a href="/employees" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                {{ app()->getLocale() === 'am' ? 'ሰራተኞች' : 'Employees' }}
                            </a>
                            @if(auth()->user()->isAdmin())
                            <a href="/audit-logs" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                {{ app()->getLocale() === 'am' ? 'ኦዲት ሎግ' : 'Audit Logs' }}
                            </a>
                            @endif
                        </div>
                        @endauth
                    </div>

                    <!-- Right Side -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Language Switcher -->
                        <div class="mr-4">
                            <button onclick="switchLanguage('{{ app()->getLocale() === 'am' ? 'en' : 'am' }}')" 
                                    class="px-3 py-1 text-sm text-gray-700 hover:text-gray-900 border border-gray-300 rounded-md">
                                {{ app()->getLocale() === 'am' ? 'English' : 'አማርኛ' }}
                            </button>
                        </div>

                        @auth
                        <!-- User Dropdown -->
                        <div class="relative">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                                <span>{{ auth()->user()->name }}</span>
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
