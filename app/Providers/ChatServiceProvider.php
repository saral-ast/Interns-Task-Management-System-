<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

class ChatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register chat routes
        Route::middleware('web')
            ->group(base_path('routes/chat.php'));

        // Register broadcast channels
        Broadcast::routes(['middleware' => ['web', 'auth:admin,user']]);

        require base_path('routes/channels.php');
    }
}