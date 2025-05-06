<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::guard('user')->user();
        $tasks = $user->assignedTasks()->get();
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
    }
}
