<x-layout>
    <x-navigation>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-medium text-gray-900">
                                Create New Task
                            </h1>
                            <a href="{{ route('admin.tasks') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to List
                            </a>
                        </div>

                        <form method="POST" action="{{ route('admin.tasks.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="title" class="block font-medium text-base text-gray-700">Task Title</label>
                                    <input type="text" name="title" id="title" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required autofocus />
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block font-medium text-base text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required></textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block font-medium text-base text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required>
                                        <option value="pending">Pending</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="due_date" class="block font-medium text-base text-gray-700">Due Date</label>
                                    <input type="datetime-local" name="due_date" id="due_date" class="mt-1 block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required />
                                    @error('due_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block font-medium text-base text-gray-700 mb-2">Assign To</label>
                                    <div class="space-y-2 max-h-60 overflow-y-auto p-3 border rounded-md border-gray-300">
                                        @foreach($users as $user)
                                            <div class="flex items-center">
                                                <input type="checkbox" name="assigned_users[]" id="user_{{ $user->id }}" value="{{ $user->id }}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ in_array($user->id, old('assigned_users', [])) ? 'checked' : '' }}>
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
                                    Create Task
                                </button>
                                <a href="{{ route('admin.tasks') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-navigation>
</x-layout>