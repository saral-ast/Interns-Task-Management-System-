<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/intern.php';
require_once __DIR__ . '/admin.php';

// Home redirect to dashboard
Route::get('/', function() {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::guard('user')->check()) {
        return redirect()->route('intern.dashboard');
    }
    return redirect()->route('intern.login');
})->name('home');

// Unified dashboard view
Route::get('/dashboard', function() {
    return view('dashboard');
})->name('dashboard');