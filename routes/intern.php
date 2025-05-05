<?php

use App\Http\Controllers\Auth\InternLoginController;
use App\Http\Controllers\Auth\InternRegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('intern')->group(function () {
    Route::middleware("guest:user")->group(function() {
        Route::get('/login',[InternLoginController::class,'index'])->name('intern.login');
        Route::post('/login',[InternLoginController::class,'login'])->name('intern.authenticate');
        
        Route::get('/register', [InternRegisterController::class, 'index'])->name('intern.register');
        Route::post('/register', [InternRegisterController::class, 'register'])->name('intern.register.submit');
    });

    Route::middleware("auth:user")->group(function() {
        Route::post( '/logout',[InternLoginController::class,'logout'])->name('intern.logout');
        Route::get('/', function() {
            return redirect()->route('dashboard');
        })->name('intern.dashboard');
        
        Route::get('/tasks', function() {
            return view('intern.tasks.index');
        })->name('intern.tasks');
    });
});