<x-layout>
    <x-navigation>
        <div class="py-12 bg-gray-50 min-h-screen w-full">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-8">
                        <!-- Header Section -->
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">My Tasks</h2>
                                <p class="text-sm text-gray-600 mt-1">Manage and track your assigned tasks</p>
                            </div>
                        </div>
                        
                        @if($tasks->count() > 0)
                            <div class="overflow-x-auto rounded-xl border border-gray-100">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Created By</th>                                            
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Due Date</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">   
                                        @foreach($tasks as $task)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-semibold text-gray-900">{{ $task->title }}</div>
                                                    <div class="text-sm text-gray-500 mt-1">{{ Str::limit($task->description, 50) }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="px-3 py-1 text-sm font-medium rounded-full 
                                                        @if($task->status == 'completed') bg-green-100 text-green-800 
                                                        @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800 
                                                        @else bg-yellow-100 text-yellow-800 @endif">
                                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                                            <span class="text-sm font-medium text-gray-600">{{ substr($task->creator->name, 0, 1) }}</span>
                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="text-sm font-medium text-gray-900">{{ $task->creator->name }}</div>
                                                            <div class="text-sm text-gray-500">{{ $task->creator->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="{{ route('intern.tasks.show', $task) }}" 
                                                       class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-indigo-600 bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        View Details
                                                        <svg class="ml-2 -mr-0.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-12 bg-gray-50 rounded-xl border border-gray-100">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <h3 class="mt-2 text-lg font-medium text-gray-900">No tasks found</h3>
                                <p class="mt-1 text-sm text-gray-500">You don't have any tasks assigned to you yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-navigation>
</x-layout>