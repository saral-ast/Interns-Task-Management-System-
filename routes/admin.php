<?php

use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
        Route::middleware("guest:admin")->group(function() {
                Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
                Route::post('/login',[AdminLoginController::class,'login'])->name('admin.authenticate');
        });

        Route::middleware("auth:admin")->group(function() {
            Route::post('/logout',[AdminLoginController::class,'logout'])->name('admin.logout');
            Route::get('/', function() {
                return redirect()->route('dashboard');
            })->name('admin.dashboard');
            
            // Admin user management routes
            Route::get('/users', function() {
                // Placeholder for user management
                return view('admin.users.index');
            })->name('admin.users');
            
            // Admin task management routes
            Route::get('/tasks', function() {
                // Placeholder for task management
                return view('admin.tasks.index');
            })->name('admin.tasks');
            
            Route::get('/tasks/create', function() {
                // Placeholder for task creation
                return view('admin.tasks.create');
            })->name('admin.tasks.create');
            
            Route::get('/users/create', function() {
                // Placeholder for user creation
                return view('admin.users.create');
            })->name('admin.users.create');
        });
});