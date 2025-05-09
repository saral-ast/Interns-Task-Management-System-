<x-layout>
    <x-navigation>
        <div class="py-12 bg-gray-50 min-h-screen w-full">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-8">
                        <!-- Header Section -->
                        <div class="flex justify-between items-center mb-8">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Task Management</h2>
                                <p class="text-sm text-gray-600 mt-1">View and manage all system tasks</p>
                            </div>
                            @can('create_tasks')
                            <a href="{{ route('admin.tasks.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create New Task
                            </a>
                            @endcan
                        </div>

                        <!-- Tasks Table -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Due Date</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Assigned To</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($tasks as $task)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $task->title }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-600 truncate max-w-xs">{{ $task->description }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="px-3 py-1 text-sm font-medium rounded-full
                                                        @if($task->status === 'completed') bg-green-100 text-green-800
                                                        @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                                        @else bg-gray-100 text-gray-800
                                                        @endif">
                                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex flex-col space-y-2">
                                                        @foreach($task->assignedUsers as $user)
                                                            <div class="flex items-center space-x-2">
                                                                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                                                    <span class="text-sm font-medium text-indigo-600">{{ substr($user->name, 0, 1) }}</span>
                                                                </div>
                                                                <div>
                                                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center space-x-3">
                                                        <a href="{{ route('admin.tasks.edit', $task) }}" 
                                                           class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                                            View Details
                                                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                            </svg>
                                                        </a>
                
                                                        @can('delete_tasks')
                                                        <button type="button"
                                                                class="text-sm font-medium text-red-600 hover:text-red-900 delete-task"
                                                                data-id="{{ $task->id }}"
                                                                data-url="{{ route('admin.tasks.destroy', $task) }}">
                                                            Delete
                                                        </button>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if($tasks->isEmpty())
                                            <tr>
                                                <td colspan="6" class="px-6 py-8 text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                    <p class="mt-2 text-gray-500">No tasks found. Create a new task to get started.</p>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-navigation>

    <script>
        $(document).ready(function() {
            $('.delete-task').click(function(e) {
                e.preventDefault();
                var taskId = $(this).data('id');
                var deleteUrl = $(this).data('url');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4F46E5',
                    cancelButtonColor: '#EF4444',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg',
                        cancelButton: 'px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Task has been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: '#4F46E5',
                                    customClass: {
                                        confirmButton: 'px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg'
                                    }
                                }).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong.',
                                    icon: 'error',
                                    confirmButtonColor: '#4F46E5',
                                    customClass: {
                                        confirmButton: 'px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg'
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-layout>