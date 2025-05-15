<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
{
    try {
        $tasks = admin()->tasks()
            ->with([
                'assignedUsers:id,name', 
                'creator:id,name,role_id',
                'creator.role:id,name'
            ])
            ->get();

        return view('admin.dashboard', [
            'tasks' => $tasks,
            'latestTasks' => $tasks->sortByDesc('created_at')->take(5)->values(),
            'activeTasksCount' => $tasks->whereIn('status', ['pending', 'in_progress'])->count(),
            'completedTasksCount' => $tasks->where('status', 'completed')->count(),
            'totalTasksCount' => $tasks->count()
        ]);
    } catch (Exception $e) {
        Log::error('Error in admin dashboard: ' . $e->getMessage());

        return view('admin.dashboard', [
            'error' => 'An error occurred while loading the dashboard. Please try again.'
        ]);
    }
}

}