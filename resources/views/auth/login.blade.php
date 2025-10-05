<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'AfarRHB Inventory') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    {{ app()->getLocale() === 'am' ? 'ወደ የአፋር ክልል ጤና ቢሮ ይግቡ' : 'Sign in to AfarRHB' }}
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    {{ app()->getLocale() === 'am' ? 'የእቃ ዝርዝር አስተዳደር ስርዓት' : 'Inventory Management System' }}
                </p>
            </div>
            
            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="text-sm text-red-800">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">{{ app()->getLocale() === 'am' ? 'ኢሜል አድራሻ' : 'Email address' }}</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm" 
                               placeholder="{{ app()->getLocale() === 'am' ? 'ኢሜል አድራሻ' : 'Email address' }}"
                               value="{{ old('email') }}">
                    </div>
                    <div>
                        <label for="password" class="sr-only">{{ app()->getLocale() === 'am' ? 'የይለፍ ቃል' : 'Password' }}</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm" 
                               placeholder="{{ app()->getLocale() === 'am' ? 'የይለፍ ቃል' : 'Password' }}">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                               class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            {{ app()->getLocale() === 'am' ? 'አስታውሰኝ' : 'Remember me' }}
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        {{ app()->getLocale() === 'am' ? 'ግባ' : 'Sign in' }}
                    </button>
                </div>
                
                <div class="text-center">
                    <a href="/?lang={{ app()->getLocale() === 'am' ? 'en' : 'am' }}" class="text-sm text-primary-600 hover:text-primary-500">
                        {{ app()->getLocale() === 'am' ? 'English' : 'አማርኛ' }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
