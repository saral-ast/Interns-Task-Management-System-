<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index() {
        try {
            $user = Auth::guard('user')->user();
            $tasks = $user->assignedTasks()->with(['creator'])->get();
            $latestTasks = $tasks->sortByDesc('created_at')->take(5);
            $activeTasksCount = $tasks->whereIn('status', ['pending', 'in_progress'])->count();
            $completedTasksCount = $tasks->where('status', 'completed')->count();
            $totalTasksCount = $tasks->count();

            return view('intern.dashboard', [
                'tasks' => $tasks,
                'latestTasks' => $latestTasks,
                'activeTasksCount' => $activeTasksCount,
                'completedTasksCount' => $completedTasksCount,
                'totalTasksCount' => $totalTasksCount
            ]);
        } catch (Exception $e) {
            Log::error('Error in intern dashboard: ' . $e->getMessage());
            return view('intern.dashboard', [
                'error' => 'An error occurred while loading the dashboard. Please try again.'
            ]);
        }
    }
}