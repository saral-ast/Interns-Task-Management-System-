<x-layout>
    <x-navigation>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Welcome, {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::guard('user')->user()->name }}!</h2>
            <p class="text-gray-600">Here you can manage tasks and track interns progress.</p>
            
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                    <h3 class="text-lg font-medium text-blue-800 mb-2">Active Tasks</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $activeTasksCount }}</p>
                </div>
                
                <div class="bg-green-50 p-6 rounded-lg border border-green-100">
                    <h3 class="text-lg font-medium text-green-800 mb-2">Completed Tasks</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $completedTasksCount }}</p>
                </div>
                
                <div class="bg-purple-50 p-6 rounded-lg border border-purple-100">
                    <h3 class="text-lg font-medium text-purple-800 mb-2">Total Tasks</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalTasksCount }}</p>
                </div>
            </div>

            <!-- Latest Tasks Section -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Latest Tasks</h3>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="divide-y divide-gray-200">
                        @forelse($latestTasks as $task)
                            <div class="p-4 hover:bg-gray-50 transition-colors duration-150">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-base font-medium text-gray-900">{{ $task->title }}</h4>
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($task->description, 100) }}</p>
                                        <div class="mt-2 flex items-center gap-2">
                                            <div class="text-sm text-gray-500">
                                                <span class="font-medium">Created by:</span> 
                                                {{ $task->creator ? $task->creator->name : 'Unknown' }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <span class="font-medium">Assigned to:</span>
                                                {{ $task->assignedUsers->pluck('name')->join(', ') ?: 'Unassigned' }}
                                            </div>
                                        </div>
                                    </div>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($task->status === 'completed') bg-green-100 text-green-800
                                        @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-center text-gray-500">
                                No tasks found.
                            </div>
                        @endforelse
                    </div>
                    @if($tasks->count() > 5)
                        <div class="p-4 border-t border-gray-200 bg-gray-50">
                            <a href="{{ route('admin.tasks') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                View all tasks →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-navigation>
</x-layout>