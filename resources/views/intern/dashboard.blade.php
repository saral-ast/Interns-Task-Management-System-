<x-layout>
    <x-navigation>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-2xl font-semibold mb-6">Welcome, {{ Auth::guard('user')->user()->name }}!</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <!-- Active Tasks Card -->
                            <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                                <h3 class="text-lg font-medium text-blue-800 mb-2">Active Tasks</h3>
                                <p class="text-3xl font-bold text-blue-600">{{ $activeTasksCount }}</p>
                            </div>
                            
                            <!-- Completed Tasks Card -->
                            <div class="bg-green-50 p-6 rounded-lg border border-green-100">
                                <h3 class="text-lg font-medium text-green-800 mb-2">Completed Tasks</h3>
                                <p class="text-3xl font-bold text-green-600">{{ $completedTasksCount }}</p>
                            </div>
                            
                            <!-- Total Tasks Card -->
                            <div class="bg-purple-50 p-6 rounded-lg border border-purple-100">
                                <h3 class="text-lg font-medium text-purple-800 mb-2">Total Tasks</h3>
                                <p class="text-3xl font-bold text-purple-600">{{ $totalTasksCount }}</p>
                            </div>
                        </div>

                        <!-- Recent Tasks Section -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="p-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">Recent Tasks</h3>
                            </div>
                            <div class="divide-y divide-gray-200">
                                @forelse($latestTasks as $task)
                                    <div class="p-4 hover:bg-gray-50 transition-colors duration-150">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="text-base font-medium text-gray-900">{{ $task->title }}</h4>
                                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($task->description, 100) }}</p>
                                            </div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($task->status === 'completed') bg-green-100 text-green-800
                                                @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-4 text-center text-gray-500">
                                        No tasks assigned yet.
                                    </div>
                                @endforelse
                            </div>
                            @if($tasks->count() > 5)
                                <div class="p-4 border-t border-gray-200 bg-gray-50">
                                    <a href="{{ route('intern.tasks') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                        View all tasks →
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