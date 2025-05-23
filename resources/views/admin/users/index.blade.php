<x-layout>
    <x-navigation>
        <div class="py-12 bg-gray-50 min-h-screen w-full">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-8">
                        <!-- Header Section -->
                        <div class="flex justify-between items-center mb-8">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Manage Users</h2>
                                <p class="text-sm text-gray-600 mt-1">View and manage all system users</p>
                            </div>
                            <a href="{{ route('admin.users.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add New User
                            </a>
                        </div>

                        <!-- Users Table -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Joined Date</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($users as $user)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                                            <span class="text-sm font-medium text-indigo-600">{{ substr($user->name, 0, 1) }}</span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="px-3 py-1 text-sm font-medium rounded-full bg-indigo-100 text-indigo-800">
                                                        {{ $user->role->name }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center space-x-3">
                                                        <a href="{{ route('admin.interns.edit', $user->id) }}" 
                                                           class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                                            Edit |&nbsp;
                                                        </a>
                                                        <button type="button"
                                                                class="text-sm font-medium text-red-600 hover:text-red-900 delete-user"
                                                                data-id="{{ $user->id }}"
                                                                data-url="{{ route('admin.interns.destroy', $user->id) }}">
                                                             Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-navigation>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.delete-user').click(function(e) {
                e.preventDefault();
                var userId = $(this).data('id');
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
                                    text: 'User has been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: '#4F46E5',
                                    customClass: {
                                        confirmButton: 'px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg'
                                    }
                                }).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
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