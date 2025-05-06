<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = \App\Models\Task::all();
        $latestTasks = \App\Models\Task::latest()->take(5)->get();
        $activeTasksCount = $tasks->whereIn('status', ['pending', 'in_progress'])->count();
        $completedTasksCount = $tasks->where('status', 'completed')->count();
        $totalTasksCount = $tasks->count();

        $data = [
            'title' => 'Dashboard',
            'subTitle' => 'Dashboard',
            'tasks' => $tasks,
            'latestTasks' => $latestTasks,
            'activeTasksCount' => $activeTasksCount,
            'completedTasksCount' => $completedTasksCount,
            'totalTasksCount' => $totalTasksCount
        ];
        return view('admin.dashboard', $data);
    }
}
