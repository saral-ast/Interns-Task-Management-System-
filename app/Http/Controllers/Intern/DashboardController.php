<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $tasks = Auth::guard('user')->user()->tasks()->get();
        return view('interns.dashboard',[
            'tasks' => $tasks
        ]);
    }
}
