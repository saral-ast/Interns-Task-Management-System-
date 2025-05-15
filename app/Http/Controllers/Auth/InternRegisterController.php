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
            $data['role_id'] = 2;
            $user = User::create($data);
            Auth::guard('user')->login($user);
            
            return redirect()->route('intern.dashboard');
        } catch (Exception $e) {
            return back()->withErrors(['email' => 'Registration failed. Please try again.'])->withInput($data);
        }
    }
} 