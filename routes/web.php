<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\IssuanceController;

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Items
    Route::resource('items', ItemController::class);
    
    // Issuances
    Route::resource('issuances', IssuanceController::class);
    Route::get('/issuances/{issuance}/print', [IssuanceController::class, 'print'])->name('issuances.print');
    
    // Employees
    Route::get('/employees', function() {
        $employees = \App\Models\Employee::where('is_active', true)->paginate(15);
        return view('employees.index', compact('employees'));
    })->name('employees.index');
    
    // Audit Logs (Admin only)
    Route::middleware(function ($request, $next) {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        return $next($request);
    })->group(function () {
        Route::get('/audit-logs', function() {
            $logs = \App\Models\AuditLog::with('user')->latest()->paginate(20);
            return view('audit-logs.index', compact('logs'));
        })->name('audit-logs.index');
    });
    
    // Language switcher
    Route::get('/language/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'am'])) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }
        return redirect()->back();
    })->name('language.switch');
});
