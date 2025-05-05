<x-layout>
    <x-navigation>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Task Management</h2>
                <a href="{{ route('admin.tasks.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create New Task
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tasks as $task)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $task->title }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 truncate max-w-xs">{{ $task->description }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($task->status === 'completed') bg-green-100 text-green-800
                                        @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $task->assignedUser->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $task->assignedUser->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                    <a href="#" class="text-red-600 hover:text-red-900 delete-task" data-id="{{ $task->id }}" data-url="{{ route('admin.tasks.destroy', $task) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                        @if($tasks->isEmpty())
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No tasks found. Create a new task to get started.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
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
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Task has been deleted.',
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-layout>