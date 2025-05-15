<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('auth.adminLogin');
        } catch (Exception $e) {
            Log::error('Error displaying admin login page: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }

    public function login(AdminLoginRequest $request){
        try {
            $credentials = $request->validated();
            
            if(Auth::guard('admin')->attempt($credentials)){
                $request->session()->regenerate();                
                return redirect()->route('admin.dashboard');
            }

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
        } catch (Exception $e) {
            Log::error('Error during admin login: ' . $e->getMessage());
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'An error occurred during login. Please try again.',
                ]);
        }
    }

    public function logout(){
        try {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        } catch (Exception $e) {
            Log::error('Error during admin logout: ' . $e->getMessage());
            return redirect()->route('admin.login')->with('error', 'An error occurred during logout. Please try again.');
        }
    }
}