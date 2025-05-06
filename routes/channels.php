<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

// Admin chat channel authorization
Broadcast::channel('chat.admin.{id}', function ($user, $id) {
    // Check if user is admin with matching ID
    return Auth::guard('admin')->check() && Auth::guard('admin')->id() === (int) $id;
});

// Intern chat channel authorization
Broadcast::channel('chat.intern.{id}', function ($user, $id) {
    // Check if user is intern with matching ID
    return Auth::guard('user')->check() && Auth::guard('user')->id() === (int) $id;
});