<?php

use App\Http\Controllers\Admin\AdminControllers;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\UserController;
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
            Route::get('/users', [UserController::class, 'index'])->name('admin.interns');
            Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
            Route::post('/users', [UserController::class, 'store'])->name('admin.interns.store');
            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.interns.edit');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.interns.update');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.interns.destroy');

            Route::get('/admins',[AdminControllers::class,'index'])->name('admin.admins'); 
            Route::get('/admin/create', [AdminControllers::class,'create'])->name('admin.admins.create'); 
            Route::post('/admin', [AdminControllers::class,'store'])->name('admin.admins.store');

            Route::get('/admin/{admin}/edit', [AdminControllers::class, 'edit'])->name('admin.admins.edit');
            Route::put('/admin/{admin}', [AdminControllers::class, 'update'])->name('admin.admins.update');
            Route::delete('/admin/{admin}', [AdminControllers::class, 'destroy'])->name('admin.admins.destroy'); 
            
            // Admin task management routes
            Route::get('/tasks', [TaskController::class, 'index'])->name('admin.tasks');
            
            Route::get('/tasks/create', [TaskController::class, 'create'])->name('admin.tasks.create');
            Route::post('/tasks', [TaskController::class,'store'])->name('admin.tasks.store');
            Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('admin.tasks.edit');
            Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('admin.tasks.update');
            Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('admin.tasks.destroy');
            
            // Route::get('/users/create', [])->name('admin.users.create');
        });
});