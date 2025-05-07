<x-layout>
    <x-navigation>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-medium text-gray-900">
                        Create New Intern
                    </h1>

                    <x-forms.form method="POST" action="{{ route('admin.interns.store') }}" class="mt-6 space-y-6" id="userCreateForm">
                        @csrf

                        <div class="space-y-4">
                            <x-forms.input 
                                name="name" 
                                label="Full Name" 
                                type="text" 
                                placeholder="Enter intern's full name"
                                value="{{ old('name') }}"
                                autocomplete="name"
                            />

                            <x-forms.input 
                                name="email" 
                                label="Email Address" 
                                type="email" 
                                placeholder="Enter intern's email address"
                                value="{{ old('email') }}"
                                autocomplete="email"
                            />

                            <x-forms.input 
                                name="password" 
                                label="Password" 
                                type="password"  
                                placeholder="Create a password"
                                autocomplete="new-password"
                            />

                            <x-forms.input 
                                name="password_confirmation" 
                                label="Confirm Password" 
                                type="password"
                                placeholder="Confirm the password"
                                autocomplete="new-password"
                            />
                        </div>

                        <input type="hidden" name="role_id" value="3">

                        <div class="flex items-center gap-6 mt-10">
                            <x-forms.button class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Create Intern
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
   $(document).ready(function() {
    

        // Initialize form validation
        $('#userCreateForm').validate({
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
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
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
                    required: "Please enter a password",
                    minlength: "Password must be at least 8 characters long"
                },
                password_confirmation: {
                    required: "Please confirm the password",
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



