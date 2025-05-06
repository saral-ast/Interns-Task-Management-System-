<?php

use Illuminate\Support\Facades\Broadcast;

// Admin chat channel authorization
Broadcast::channel('chat.admin.{id}', function ($user, $id) {
    return $user->guard('admin') && $user->id === (int) $id;
});

// Intern chat channel authorization
Broadcast::channel('chat.intern.{id}', function ($user, $id) {
    return !$user->guard('admin') && $user->id === (int) $id;
});