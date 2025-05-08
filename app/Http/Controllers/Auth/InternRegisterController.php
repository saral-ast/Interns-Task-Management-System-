<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\InternRegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InternRegisterController extends Controller
{
    /**
     * Display the registration form.
     */
    public function index()
    {
        return view('auth.internRegister');
    }

    /**
     * Handle the registration request.
     */
    public function register(InternRegisterRequest $request)
    {
        try {
            $data = $request->validated();
            
            // Create the user
            // dd($data);
            $data['role_id'] = 2;
            // dd($data);
            $user = User::create($data);
            // dd('sdf');
            // Log the user in
            Auth::guard('user')->login($user);
            
            return redirect()->route('intern.dashboard');
        } catch (Exception $e) {
            return back()->withErrors(['email' => 'Registration failed. Please try again.'])->withInput($data);
        }
    }
} 