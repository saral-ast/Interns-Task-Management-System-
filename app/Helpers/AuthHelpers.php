<?php

use Illuminate\Support\Facades\Auth;


function admin()
{
    return Auth::guard('admin')->user();
}

/**
 * Get the currently authenticated user/intern
 *
 * @return \App\Models\User|null
 */
function intern()
{
    return Auth::guard('user')->user();
}


function isAdmin()
{
    return Auth::guard('admin')->check();
}

function isIntern()
{
    return Auth::guard('user')->check();
}

function isSuperAdmin()
{
    return admin()->role->name == 'super_admin';
}