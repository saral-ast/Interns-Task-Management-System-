<?php

use App\Http\Controllers\Admin\AdminControllers;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
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
            Route::get('/', [DashboardController::class,'index'])->name('admin.dashboard');

            
            
            // Admin user management routes
            Route::get('/users', [UserController::class, 'index'])->name('admin.interns')->can('read_interns');
            Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create')->can('create_interns');
            Route::post('/users', [UserController::class, 'store'])->name('admin.interns.store')->can('create_interns');
            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.interns.edit')->can('update_interns');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.interns.update')->can('update_interns');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.interns.destroy')->can('delete_interns');

            Route::get('/admins',[AdminControllers::class,'index'])->name('admin.admins')->can('read_admins'); 
            Route::get('/admin/create', [AdminControllers::class,'create'])->name('admin.admins.create')->can('create_admins'); 
            Route::post('/admin', [AdminControllers::class,'store'])->name('admin.admins.store')->can('create_admins');
            Route::get('/admin/{admin}/edit', [AdminControllers::class, 'edit'])->name('admin.admins.edit')->can('update_admins');
            Route::put('/admin/{admin}', [AdminControllers::class, 'update'])->name('admin.admins.update')->can('update_admins');
            Route::delete('/admin/{admin}', [AdminControllers::class, 'destroy'])->name('admin.admins.destroy')->can('delete_admins'); 
            
            // Admin task management routes
            Route::get('/tasks', [TaskController::class, 'index'])->name('admin.tasks')->can('read_tasks');
            Route::get('/tasks/create', [TaskController::class, 'create'])->name('admin.tasks.create')->can('create_tasks');
            Route::post('/tasks', [TaskController::class,'store'])->name('admin.tasks.store')->can('create_tasks');
            Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('admin.tasks.edit')->can('update_tasks');
            Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('admin.tasks.update')->can('update_tasks');
            Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('admin.tasks.destroy')->can('delete_tasks');
            
            Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('admin.tasks.comments.store');
            Route::delete('/tasks/{task}/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.tasks.comments.destroy');
            
            // Route::get('/users/create', [])->name('admin.users.create');
        });
});