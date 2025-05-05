<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\InternLoginRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class InternLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.internLogin');
    }

    public function login(InternLoginRequest $request){
        try {
             $credentials = $request->validated();
            //  dd(Auth::guard('user')->attempt($credentials));
             if(Auth::guard('user')->attempt($credentials)){
                 
                  $user = Auth::guard('user')->user();
                //   dd($user);
                  return redirect()->route('intern.dashboard',[
                      'user' => $user
                  ]);
             }
             return redirect()->route('intern.login')->with('error','Invalid credentials');
        } catch (Exception $e) {
             throw $e;
        }
        
        
    }

     public function logout(){
        try {
         
            Auth::guard('user')->logout();
            return redirect()->route('intern.login');
        } catch (Exception $e) {
            throw $e;
        }
    }
}