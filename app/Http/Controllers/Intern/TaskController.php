<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        $user = Auth::guard('user')->user();
        $tasks = $user->assignedTasks;
        return view('intern.tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function show(Task $task) {
        // Ensure the task is assigned to the authenticated user
        if (!$task->assignedUsers->contains(Auth::guard('user')->id())) {
            abort(403);
        }
        return view('intern.tasks.show', ['task' => $task]);
    }


}
