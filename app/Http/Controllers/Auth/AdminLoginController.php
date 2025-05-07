<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.adminLogin');
    }

    public function login(AdminLoginRequest $request){
        try {
            $credentials = $request->validated();
            
            if(Auth::guard('admin')->attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
        } catch (Exception $e) {
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
            //throw $th;
            throw $e;
        }
    }
}