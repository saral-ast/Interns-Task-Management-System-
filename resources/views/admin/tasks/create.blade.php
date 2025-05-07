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

                        <x-forms.form method="POST" action="{{ route('admin.tasks.store') }}" class="mt-6 space-y-6" id="taskCreateForm">
                            <div class="space-y-4">
                                <x-forms.input 
                                    name="title" 
                                    label="Task Title" 
                                    type="text" 
                                     
                                    placeholder="Enter task title"
                                    value="{{ old('title') }}"
                                />

                                <x-forms.input 
                                    name="description" 
                                    label="Description" 
                                    type="textarea" 
                                     
                                    placeholder="Enter task description"
                                    value="{{ old('description') }}"
                                />

                                <x-forms.select name="status" label="Status">
                                    <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </x-forms.select>

                                <x-forms.input 
                                    name="due_date" 
                                    label="Due Date" 
                                    type="date" 
                                     
                                    value="{{ old('due_date') }}"
                                />

                                <div>
                                    <label class="block font-medium text-base text-gray-700 mb-2">Assign Interns</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($users as $user)
                                            <div class="flex items-center">
                                                <x-forms.checkbox 
                                                    name="assigned_users[]" 
                                                    label="{{ $user->name }}"
                                                    value="{{ $user->id }}"
                                                    checked="{{ in_array($user->id, old('assigned_users', [])) ? 'checked' : '' }}"
                                                />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6 mt-10">
                                <x-forms.button class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Create Task
                                </x-forms.button>
                                <a href="{{ route('admin.tasks') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                                    Cancel
                                </a>
                            </div>
                        </x-forms.form>
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

        // Initialize form validation
        $('#taskCreateForm').validate({
            rules: {
                title: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                description: {
                    required: true,
                    minlength: 10
                },
                status: {
                    required: true
                },
                due_date: {
                    required: true,
                    date: true
                },
                'assigned_users[]': {
                    required: true,
                    minlength: 1
                }
            },
            messages: {
                title: {
                    required: "Please enter a task title",
                    minlength: "Title must be at least 3 characters long",
                    maxlength: "Title cannot exceed 255 characters"
                },
                description: {
                    required: "Please enter a task description",
                    minlength: "Description must be at least 10 characters long"
                },
                status: {
                    required: "Please select a status"
                },
                due_date: {
                    required: "Please select a due date",
                    date: "Please enter a valid date"
                },
                'assigned_users[]': {
                    required: "Please select at least one intern",
                    minlength: "Please select at least one intern"
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
    });
</script>
@endpush
</x-layout>

