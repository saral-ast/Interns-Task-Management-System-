<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['assignedUsers', 'creator'])->get();
        
        $latestTasks = Task::with(['assignedUsers', 'creator'])
            ->latest()
            ->take(5)
            ->get();
            
        $activeTasksCount = $tasks->whereIn('status', ['pending', 'in_progress'])->count();
        $completedTasksCount = $tasks->where('status', 'completed')->count();
        $totalTasksCount = $tasks->count();

        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'subTitle' => 'Dashboard',
            'tasks' => $tasks,
            'latestTasks' => $latestTasks,
            'activeTasksCount' => $activeTasksCount,
            'completedTasksCount' => $completedTasksCount,
            'totalTasksCount' => $totalTasksCount
        ]);
    }
}
