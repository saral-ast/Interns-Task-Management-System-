<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/intern.php';
require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/chat.php';
require_once __DIR__ . '/channels.php';

// Home redirect to dashboard
Route::get('/', function() {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::guard('user')->check()) {
        return redirect()->route('intern.dashboard');
    }
    return redirect()->route('intern.login');
})->name('home');

