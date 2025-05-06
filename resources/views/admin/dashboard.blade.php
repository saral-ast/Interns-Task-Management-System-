<x-layout>
    <x-navigation>
        <div class="py-12 bg-gray-50 min-h-screen w-full">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-8">
                        <div class="flex items-center mb-8">
                            <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                                <span class="text-xl font-bold text-indigo-600">{{ substr(Auth::guard('admin')->user()->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Welcome, {{ Auth::guard('admin')->user()->name }}!</h2>
                                <p class="text-sm text-gray-600 mt-1">Here's your task overview</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                            <!-- Active Tasks Card -->
                            <div class="bg-white p-6 rounded-xl border-2 border-blue-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Active Tasks</h3>
                                        <p class="text-3xl font-bold text-blue-600">{{ $activeTasksCount }}</p>
                                    </div>
                                    <div class="p-3 bg-blue-50 rounded-full">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Completed Tasks Card -->
                            <div class="bg-white p-6 rounded-xl border-2 border-green-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Completed Tasks</h3>
                                        <p class="text-3xl font-bold text-green-600">{{ $completedTasksCount }}</p>
                                    </div>
                                    <div class="p-3 bg-green-50 rounded-full">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Total Tasks Card -->
                            <div class="bg-white p-6 rounded-xl border-2 border-purple-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Total Tasks</h3>
                                        <p class="text-3xl font-bold text-purple-600">{{ $totalTasksCount }}</p>
                                    </div>
                                    <div class="p-3 bg-purple-50 rounded-full">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Tasks Section -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                            <div class="p-6 border-b border-gray-100">
                                <h3 class="text-xl font-semibold text-gray-900">Recent Tasks</h3>
                            </div>
                            <div class="divide-y divide-gray-100 max-h-[calc(100vh-24rem)] overflow-y-auto">
                                @forelse($latestTasks as $task)
                                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-grow">
                                                <h4 class="text-lg font-medium text-gray-900">{{ $task->title }}</h4>
                                                <p class="text-gray-600 mt-1">{{ Str::limit($task->description, 100) }}</p>
                                                <div class="mt-2 flex items-center gap-4 text-sm text-gray-500">
                                                    <div>
                                                        <span class="font-medium">Created by:</span> 
                                                        {{ $task->creator ? $task->creator->name : 'Unknown' }}
                                                    </div>
                                                    <div>
                                                        <span class="font-medium">Assigned to:</span>
                                                        {{ $task->assignedUsers->pluck('name')->join(', ') ?: 'Unassigned' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 text-sm font-medium rounded-full
                                                @if($task->status === 'completed') bg-green-100 text-green-800
                                                @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-6 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <p class="mt-2">No tasks found.</p>
                                    </div>
                                @endforelse
                            </div>
                            @if($latestTasks->count() > 5)
                                <div class="p-6 border-t border-gray-100 bg-gray-50">
                                    <a href="{{ route('admin.tasks') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                                        View all tasks
                                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-navigation>
</x-layout>