<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

// Admin chat channel authorization
Broadcast::channel('chat.admin.{id}', function ($id) {
    // Check if user is admin with matching ID
    return admin()->id === (int) $id;
});

// Intern chat channel authorization
Broadcast::channel('chat.intern.{id}', function ($id) {
    // Check if user is intern with matching ID
    return intern()->id === (int) $id;
});