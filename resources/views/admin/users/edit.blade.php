<x-layout>
    <x-navigation>
    <!-- Include jQuery and SweetAlert2 in the head section -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-medium text-gray-900">
                            Edit Intern
                        </h1>
                        <a href="{{ route('admin.interns') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to List
                        </a>
                    </div>

                    <x-forms.form method="POST" action="{{ route('admin.interns.update', $user) }}" class="mt-6 space-y-6" id="userEditForm">
                        @method('PUT')
                        <div class="space-y-4">
                            <x-forms.input 
                                name="name" 
                                label="Full Name" 
                                type="text"
                                value="{{ old('name', $user->name) }}" 
                                required 
                                placeholder="Enter intern's full name"
                                autocomplete="name"
                            />
                            
                            <x-forms.input 
                                name="email" 
                                label="Email Address" 
                                type="email" 
                                value="{{ old('email', $user->email) }}"
                                required 
                                placeholder="Enter intern's email address"
                                autocomplete="email"
                            />
                            
                            <x-forms.input 
                                name="password" 
                                label="Password" 
                                type="password" 
                                placeholder="Enter new password (leave empty to keep current)"
                                autocomplete="new-password"
                            />
                            
                            <x-forms.input 
                                name="password_confirmation" 
                                label="Confirm Password" 
                                type="password" 
                                placeholder="Confirm new password"
                                autocomplete="new-password"
                            />
                        </div>

                        <input type="hidden" name="role_id" value="3">

                        <div class="flex items-center gap-6 mt-10">
                            <x-forms.button class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Update Intern
                            </x-forms.button>
                            <a href="{{ route('admin.interns') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
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
        $('#userEditForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    minlength: 8
                },
                password_confirmation: {
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    required: "Please enter the intern's name",
                    minlength: "Name must be at least 2 characters long"
                },
                email: {
                    required: "Please enter the intern's email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    minlength: "Password must be at least 8 characters long"
                },
                password_confirmation: {
                    equalTo: "Passwords do not match"
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

