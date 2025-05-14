<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('admin')) {
    /**
     * Get the currently authenticated admin
     * 
     * @return \App\Models\Admin|null
     */
    function admin()
    {
        return Auth::guard('admin')->user();
    }
}

if (!function_exists('intern')) {
    /**
     * Get the currently authenticated user/intern
     *
     * @return \App\Models\User|null
     */
    function intern()
    {
        return Auth::guard('user')->user();
    }
} 