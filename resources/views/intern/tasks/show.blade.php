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

                            {{-- <div class="flex items-center gap-6 mt-10">
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Update Status
                                </button>
                            </div> --}}
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </x-navigation>
</x-layout>