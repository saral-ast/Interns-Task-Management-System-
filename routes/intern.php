<?php


use App\Http\Controllers\Auth\InternLoginController;
use App\Http\Controllers\Auth\InternRegisterController;
use App\Http\Controllers\Intern\CommentController;
use App\Http\Controllers\Intern\DashboardController;
use App\Http\Controllers\Intern\TaskController;
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
       Route::get('/dashboard', [DashboardController::class, 'index'])->name('intern.dashboard');
        
        Route::get('/tasks', [TaskController::class, 'index'])->name('intern.tasks');
        Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('intern.tasks.show');
        Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('intern.tasks.comments.store');
        Route::delete('/tasks/{task}/comments/{comment}', [CommentController::class, 'destroy'])->name('intern.tasks.comments.destroy');
        // Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('intern.tasks.update');
    });
});