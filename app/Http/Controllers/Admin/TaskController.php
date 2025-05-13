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
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index() {
        try {
            $tasks = Auth::guard('admin')->user()
                ->tasks()
                ->with([
                    'assignedUsers',
                    'creator'
                ])
                ->get();
                
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
            // Load task with all necessary relationships in a single query
            $taskWithRelations = Task::with([
                'assignedUsers',
                'comments' => function($query) {
                    $query->orderBy('created_at', 'desc');
                },
                'comments.user' // Eager load the comment user (polymorphic)
            ])->findOrFail($task->id);
            
            // Load all users for the form dropdown
            $users = User::all();
            
            return view('admin.tasks.edit', [
                'task' => $taskWithRelations,
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
            
            // Update task attributes and assigned users in a transaction
            DB::transaction(function() use ($task, $validated) {
                // Update task attributes
                $task->update($validated);
                
                // Use syncWithoutDetaching if you only want to add relationships without removing existing ones
                // Or use sync with the exact array of IDs when you want to add and remove relationships
                if(isset($validated['assigned_users'])) {
                    // When we know exactly which users should be attached, sync is more efficient
                    // than separate attach/detach operations
                    $task->assignedUsers()->sync($validated['assigned_users'], false);
                }
            });
            
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