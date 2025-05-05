<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();
        // dd('adasd');
        return view('admin.tasks.index',[
            'tasks' => $tasks
        ]);
    }

    public function create() {
        $users = User::all();
        return view('admin.tasks.create',[
            'users' => $users
        ]);
    }

public function store(TaskRequest $request) {
        $validated = $request->validated();
        $admin = Auth::guard('admin')->user();
        $validated['created_by'] = $admin->id;
        $task = Task::create($validated);
        // dd($task);

        return redirect()->route('admin.tasks')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task) {
        $users = User::all();
        return view('admin.tasks.edit',[
            'task' => $task,
            'users' => $users
        ]);
    }

    public function update(TaskRequest $request, Task $task) {
        $validated = $request->validated();
        // $validated['updated_by'] = Auth::guard('admin')->user()->id;
        $task->update($validated);
        return redirect()->route('admin.tasks')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'
        ]);
    }
}


