<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        $user = Auth::guard('user')->user();
        $tasks = $user->tasks;
        return view('intern.tasks.index', [
            'tasks' => $tasks
        ]);
    }
}
