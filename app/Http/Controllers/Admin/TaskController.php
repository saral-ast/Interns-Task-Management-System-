<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index() {
        try {
            $tasks = Task::with('assignedUsers')->get();
            return view('admin.tasks.index',[
                'tasks' => $tasks
            ]);
        } catch (Exception $e) {
            Log::error('Error in admin tasks index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading tasks. Please try again.');
        }
    }

    public function create() {
        try {
            $users = User::all();
            return view('admin.tasks.create',[
                'users' => $users
            ]);
        } catch (Exception $e) {
            Log::error('Error in task create view: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the create form. Please try again.');
        }
    }

    public function store(TaskRequest $request) {
        try {
            $validated = $request->validated();
            $admin = Auth::guard('admin')->user();
            $validated['created_by'] = $admin->id;
            
            $task = Task::create($validated);
            
            if(isset($validated['assigned_users'])) {
                $task->assignedUsers()->attach($validated['assigned_users']);
            }

            return redirect()->route('admin.tasks')->with('success', 'Task created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating task: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the task. Please try again.')
                ->withInput();
        }
    }

    public function edit(Task $task) {
        try {
            $users = User::all();
            return view('admin.tasks.edit',[
                'task' => $task->load('assignedUsers'),
                'users' => $users
            ]);
        } catch (Exception $e) {
            Log::error('Error in task edit view: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the edit form. Please try again.');
        }
    }

    public function update(TaskRequest $request, Task $task) {
        try {
            $validated = $request->validated();
            $task->update($validated);
            
            if(isset($validated['assigned_users'])) {
                $task->assignedUsers()->sync($validated['assigned_users']);
            }
            
            return redirect()->route('admin.tasks')->with('success', 'Task updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating task: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the task. Please try again.')
                ->withInput();
        }
    }

    public function destroy(Task $task)
    {
        try {
            $task->assignedUsers()->detach();
            $task->delete();
            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error deleting task: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the task'
            ], 500);
        }
    }
}