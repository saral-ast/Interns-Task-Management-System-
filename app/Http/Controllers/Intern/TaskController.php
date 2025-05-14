<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use App\Models\Task;

use Exception;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index() {
        try {
            $tasks = intern()->assignedTasks;
            return view('intern.tasks.index', [
                'tasks' => $tasks
            ]);
        } catch (Exception $e) {
            Log::error('Error in intern tasks index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading tasks. Please try again.');
        }
    }

    public function show(Task $task) {
        try {
            // Ensure the task is assigned to the authenticated user
            if (!$task->assignedUsers->contains(intern()->id)) {
                return redirect()->back()->with('error', 'You are not authorized to view this task.');
            }
            return view('intern.tasks.show', ['task' => $task]);
        } catch (Exception $e) {
            Log::error('Error showing intern task: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the task. Please try again.');
        }
    }
}