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
                  

                  return redirect()->route('admin.dashboard');
             }
             dd('sfd');
        } catch (Exception $e) {
            //throw $th;
            throw $e;
        }
    }
}