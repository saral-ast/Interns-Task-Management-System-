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
            Route::post( '/logout',[AdminLoginController::class,'logout'])->name('admin.logout');
            Route::get('/',function(){
                return view('admins.dashboard',[
                    'user' => Auth::user(),
                ]);
            })->name('admin.dashboard');
        });
});