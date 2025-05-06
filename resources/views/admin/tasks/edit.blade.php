<x-layout>
    <x-navigation>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-medium text-gray-900">
                                Edit Task
                            </h1>
                            <a href="{{ route('admin.tasks') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to List
                            </a>
                        </div>

                        <form method="POST" action="{{ route('admin.tasks.update', $task) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">
                                <div>
                                    <label for="title" class="block font-medium text-base text-gray-700">Task Title</label>
                                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required autofocus />
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block font-medium text-base text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required>{{ old('description', $task->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block font-medium text-base text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required>
                                        <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('status', $task->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="due_date" class="block font-medium text-base text-gray-700">Due Date</label>
                                    <input type="datetime-local" name="due_date" id="due_date" value="{{ old('due_date', \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required />
                                    @error('due_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

e                                <div>
                                    <label class="block font-medium text-base text-gray-700 mb-2">Assign To</label>
                                    <div class="space-y-2 max-h-60 overflow-y-auto p-3 border rounded-md border-gray-300">
                                        @foreach($users as $user)
                                            <div class="flex items-center">
                                                <input type="checkbox" name="assigned_users[]" id="user_{{ $user->id }}" value="{{ $user->id }}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ in_array($user->id, old('assigned_users', $task->assignedUsers->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                <label for="user_{{ $user->id }}" class="ml-2 block text-sm text-gray-900">{{ $user->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('assigned_users')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center gap-6 mt-10">
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Update Task
                                </button>
                                <a href="{{ route('admin.tasks') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                                    Cancel
                                </a>
                            </div>
                        </form>

                        <!-- Comments Section -->
                        <div class="mt-10 border-t pt-10">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Comments</h2>
                            
                            <!-- Add Comment Form -->
                            <form action="{{ route('admin.tasks.comments.store', $task) }}" method="POST" class="mb-6">
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
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div class="flex items-center">
                                                <span class="font-medium text-gray-900">{{ $comment->user->name }}</span>
                                                <span class="mx-2 text-gray-500">&bull;</span>
                                                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            @if($comment->user_id === Auth::guard('admin')->id() && $comment->user_type === 'admin')
                                                <form action="{{ route('admin.tasks.comments.destroy', [$task, $comment]) }}" method="POST" class="delete-comment-form">
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
</x-layout>