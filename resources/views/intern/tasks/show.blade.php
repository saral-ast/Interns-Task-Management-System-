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
                                <x-forms.input 
                                    name="title" 
                                    label="Task Title" 
                                    type="text" 
                                    value="{{ $task->title }}"
                                    disabled
                                />

                                <x-forms.input 
                                    name="description" 
                                    label="Description" 
                                    type="textarea" 
                                    value="{{ $task->description }}"
                                    rows="4"
                                    disabled
                                />

                                <x-forms.select name="status" label="Status" disabled>
                                    <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </x-forms.select>

                                <x-forms.input 
                                    name="due_date" 
                                    label="Due Date" 
                                    type="datetime-local" 
                                    value="{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\\TH:i') }}"
                                    disabled
                                />

                                <x-forms.input 
                                    name="created_by" 
                                    label="Created By" 
                                    type="text" 
                                    value="{{ $task->creator->name }}"
                                    disabled
                                />
                            </div>

                            <!-- Comments Section -->
                            <div class="mt-10">
                                <h2 class="text-lg font-medium text-gray-900 mb-4">Comments</h2>
                                
                                <!-- Add Comment Form -->
                                <x-forms.form action="{{ route('intern.tasks.comments.store', $task) }}" method="POST" class="mb-6" id="commentForm">
                                    <x-forms.input 
                                        name="comment" 
                                        label="Add a comment" 
                                        type="textarea" 
                                        required 
                                        placeholder="Add your comment here..."
                                        rows="3"
                                    />
                                    <div class="mt-3">
                                        <x-forms.button class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            Post Comment
                                        </x-forms.button>
                                    </div>
                                </x-forms.form>

                                <!-- Comments List -->
                                <div class="space-y-4">
                                    @forelse($task->comments as $comment)
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <div class="flex justify-between items-start">
                                                <div class="flex items-center">
                                                    <span class="font-medium text-gray-900">{{ $comment->user->name }}</span>
                                                    <span class="mx-2 text-gray-500">&bull;</span>
                                                    <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                @if($comment->user_id === Auth::guard('user')->id() && $comment->user_type === 'user')
                                                    <form action="{{ route('intern.tasks.comments.destroy', [$task, $comment]) }}" method="POST" class="delete-comment-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            <p class="mt-2 text-gray-700">{{ $comment->comment }}</p>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 text-center">No comments yet.</p>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Check if jQuery is loaded
            if (typeof jQuery === 'undefined') {
                console.error('jQuery is not loaded');
                return;
            }

            // Initialize comment form validation
            $('#commentForm').validate({
                rules: {
                    comment: {
                        required: true,
                        minlength: 2,
                        maxlength: 1000
                    }
                },
                messages: {
                    comment: {
                        required: "Please enter a comment",
                        minlength: "Comment must be at least 2 characters long",
                        maxlength: "Comment cannot exceed 1000 characters"
                    }
                },
                submitHandler: function (form) {
                    // Show loading state
                    const submitButton = $(form).find('button[type="submit"]');
                    submitButton.prop('disabled', true);
                    
                    // Submit the form
                    form.submit();
                },
                errorElement: 'span',
                errorClass: 'text-red-500 text-sm mt-1',
                highlight: function(element) {
                    $(element).addClass('border-red-500').removeClass('border-gray-300');
                },
                unhighlight: function(element) {
                    $(element).removeClass('border-red-500').addClass('border-gray-300');
                }
            });

            // Handle comment deletion
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