<x-layout>
    <x-navigation>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-medium text-gray-900">
                                Task Details
                            </h1>
                            <a href="{{ route('intern.tasks') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to List
                            </a>
                        </div>

                        {{-- <form method="POST" action="{{ route('intern.tasks.update', $task) }}" class="mt-6 space-y-6"> --}}
                            {{-- @csrf --}}
                            {{-- @method('PUT') --}}
                            <div class="space-y-4">
                                <div>
                                    <label for="title" class="block font-medium text-base text-gray-700">Task Title</label>
                                    <input type="text" name="title" id="title" value="{{ $task->title }}" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 bg-gray-50 p-3" disabled />
                                </div>

                                <div>
                                    <label for="description" class="block font-medium text-base text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 bg-gray-50 p-3" disabled>{{ $task->description }}</textarea>
                                </div>

                                <div>
                                    <label for="status" class="block font-medium text-base text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" disabled>
                                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="due_date" class="block font-medium text-base text-gray-700">Due Date</label>
                                    <input type="datetime-local" name="due_date" id="due_date" value="{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\\TH:i') }}" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 bg-gray-50 p-3" disabled />
                                </div>

                                <div>
                                    <label for="created_by" class="block font-medium text-base text-gray-700">Created By</label>
                                    <input type="text" name="created_by" id="created_by" value="{{ $task->creator->name }}" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 bg-gray-50 p-3" disabled />
                                </div>
                            </div>

                            <!-- Comments Section -->
                            <div class="mt-10">
                                <h2 class="text-lg font-medium text-gray-900 mb-4">Comments</h2>
                                
                                <!-- Add Comment Form -->
                                <form action="{{ route('intern.tasks.comments.store', $task) }}" method="POST" class="mb-6">
                                    @csrf
                                    <div>
                                        <label for="comment" class="sr-only">Add a comment</label>
                                        <textarea name="comment" id="comment" rows="3" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" placeholder="Add your comment here..." required></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            Post Comment
                                        </button>
                                    </div>
                                </form>

                                <!-- Comments List -->
                                <div class="space-y-4">
                                    @forelse($task->comments as $comment)
                                        <div id="comment-{{ $comment->id }}" class="bg-gray-50 rounded-lg p-4">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-grow">
                                                    <p class="text-sm text-gray-600">{{ $comment->comment }}</p>
                                                    <div class="mt-2 text-xs text-gray-500">
                                                        <a href="#comment-{{ $comment->id }}" class="font-medium hover:text-indigo-600">{{ $comment->user->name }}</a>
                                                        <span class="mx-1">•</span>
                                                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                        <span class="mx-1">•</span>
                                                        <span class="text-indigo-600">{{ ucfirst($comment->user_type) }}</span>
                                                    </div>
                                                </div>
                                                @if($comment->user_type === 'intern' && $comment->user_id === Auth::guard('user')->id())
                                                <button onclick="deleteComment({{ $task->id }}, {{ $comment->id }})" class="text-red-600 hover:text-red-800 ml-4">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 text-center py-4">No comments yet.</p>
                                    @endforelse
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </x-navigation>
    @push('scripts')
    <script>
        $(document).ready(function() {
            window.deleteComment = function(taskId, commentId) {
                Swal.fire({
                    title: 'Delete Comment',
                    text: 'Are you sure you want to delete this comment? This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/intern/tasks/${taskId}/comments/${commentId}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            success: function(data) {
                                if (data.message) {
                                    $(`#comment-${commentId}`).fadeOut(300, function() {
                                        $(this).remove();
                                    });
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Comment deleted successfully'
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Failed to delete comment'
                                });
                            }
                        });
                    }
                });
            }
        });
    </script>
    @endpush
</x-layout>