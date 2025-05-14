<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Single query for all tasks with eager loading
            $allTasks = admin()->tasks()
                ->with(['assignedUsers', 'creator'])
                ->get();
            
            // Use the collection methods instead of new queries
            $activeTasksCount = $allTasks->whereIn('status', ['pending', 'in_progress'])->count();
            $completedTasksCount = $allTasks->where('status', 'completed')->count();
            $totalTasksCount = $allTasks->count();
            
            // Get latest tasks from the collection
            $latestTasks = $allTasks->sortByDesc('created_at')->take(5)->values();

            return view('admin.dashboard', [
                'tasks' => $allTasks,
                'latestTasks' => $latestTasks,
                'activeTasksCount' => $activeTasksCount,
                'completedTasksCount' => $completedTasksCount,
                'totalTasksCount' => $totalTasksCount
            ]);
        } catch (Exception $e) {
            Log::error('Error in admin dashboard: ' . $e->getMessage());
            return view('admin.dashboard', [
                'error' => 'An error occurred while loading the dashboard. Please try again.'
            ]);
        }
    }
}