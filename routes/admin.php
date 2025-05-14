<?php

use App\Http\Controllers\Admin\AdminControllers;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\PreloadAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
        Route::middleware("guest:admin")->group(function() {
              Route::controller(AdminLoginController::class)->group(function(){
                Route::get('/login', 'index')->name('admin.login');
                Route::post('/login', 'login')->name('admin.authenticate');
              });
        });

        Route::middleware(["auth:admin", PreloadAdmin::class])->group(function() {
            Route::post('/logout',[AdminLoginController::class,'logout'])->name('admin.logout');
            Route::get('/', [DashboardController::class,'index'])->name('admin.dashboard');

            
            
            // Admin user management routes
            Route::controller(UserController::class)->prefix('users')->group(function(){
                Route::get('/', 'index')->name('admin.interns')->can('read_interns');
                Route::get('/create', 'create')->name('admin.users.create')->can('create_interns');
                Route::post('/', 'store')->name('admin.interns.store')->can('create_interns');
                Route::get('/{user}/edit', 'edit')->name('admin.interns.edit')->can('update_interns');
                Route::put('/{user}', 'update')->name('admin.interns.update')->can('update_interns');
                Route::delete('/{user}', 'destroy')->name('admin.interns.destroy')->can('delete_interns');
            });

            Route::controller(AdminControllers::class)->prefix('admins')->group(function(){
                Route::get('/', 'index')->name('admin.admins')->can('read_admins'); 
                Route::get('/create', 'create')->name('admin.admins.create')->can('create_admins'); 
                Route::post('/', 'store')->name('admin.admins.store')->can('create_admins');
                Route::get('/{admin}/edit', 'edit')->name('admin.admins.edit')->can('update_admins');
                Route::put('/{admin}', 'update')->name('admin.admins.update')->can('update_admins');
                Route::delete('/{admin}', 'destroy')->name('admin.admins.destroy')->can('delete_admins'); 
            });

            // Admin task management routes
            Route::controller(TaskController::class)->prefix('tasks')->group(function(){
                Route::get('/', 'index')->name('admin.tasks')->can('read_tasks');
                Route::get('/create', 'create')->name('admin.tasks.create')->can('create_tasks');
                Route::post('/', 'store')->name('admin.tasks.store')->can('create_tasks');
                Route::get('/{task}/edit', 'edit')->name('admin.tasks.edit')->can('update_tasks');
                Route::put('/{task}', 'update')->name('admin.tasks.update')->can('update_tasks');
                Route::delete('/{task}', 'destroy')->name('admin.tasks.destroy')->can('delete_tasks');
            });
            
            Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('admin.tasks.comments.store');
            Route::delete('/tasks/{task}/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.tasks.comments.destroy');
            
            // Route::get('/users/create', [])->name('admin.users.create');
        });
});