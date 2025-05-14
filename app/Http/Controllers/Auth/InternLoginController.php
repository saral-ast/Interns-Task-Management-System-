<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\InternLoginRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InternLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('auth.internLogin');
        } catch (Exception $e) {
            Log::error('Error displaying intern login page: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }

    public function login(InternLoginRequest $request){
        try {
             $credentials = $request->validated();
            //  dd(Auth::guard('user')->attempt($credentials));
             if(Auth::guard('user')->attempt($credentials)){
                 
                  $user = intern();
                //   dd($user);
                  return redirect()->route('intern.dashboard',[
                      'user' => $user
                  ]);
             }
             return redirect()->route('intern.login')->with('error','Invalid credentials');
        } catch (Exception $e) {
            Log::error('Error during intern login: ' . $e->getMessage());
            return redirect()->route('intern.login')
                ->withInput($request->only('email'))
                ->with('error', 'An error occurred during login. Please try again.');
        }
    }

     public function logout(){
        try {
         
            Auth::guard('user')->logout();
            return redirect()->route('intern.login');
        } catch (Exception $e) {
            Log::error('Error during intern logout: ' . $e->getMessage());
            return redirect()->route('intern.login')->with('error', 'An error occurred during logout. Please try again.');
        }
    }
}