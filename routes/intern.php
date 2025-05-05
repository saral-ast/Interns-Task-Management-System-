<?php

use App\Http\Controllers\Auth\InternLoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('intern')->group(function () {
    Route::middleware("guest:user")->group(function() {
        Route::get('/login',[InternLoginController::class,'index'])->name('intern.login');
        Route::post('/login',[InternLoginController::class,'login'])->name('intern.authenticate');
    });

    Route::middleware("auth:user")->group(function() {
        Route::get('/',function(){
          //  dd('das');
            return view('dashboard',[
                'user' => Auth::user(),
            ]);
        })->name('intern.dashboard');
    });
});