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