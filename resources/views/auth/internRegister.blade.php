<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-blue-100 flex items-center justify-center rounded-full mb-6">
                    <svg class="h-10 w-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Create Account</h2>
                <p class="text-sm text-gray-600 mb-8">
                    Register as an intern to get started
                </p>
            </div>
            
            <x-forms.form method="POST" action="{{ route('intern.register.submit') }}" class="space-y-6" id="internRegisterForm">
                <div class="space-y-5">
                    <x-forms.input 
                        name="name" 
                        label="Full Name" 
                        type="text" 
                        required 
                        placeholder="Enter your full name"
                        value="{{ old('name') }}"
                        autocomplete="name"
                    />
                    
                    <x-forms.input 
                        name="email" 
                        label="Email Address" 
                        type="email" 
                        required 
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                    />
                    
                    <x-forms.input 
                        name="password" 
                        label="Password" 
                        type="password" 
                        required 
                        placeholder="Create a password"
                        autocomplete="new-password"
                    />
                    
                    <x-forms.input 
                        name="password_confirmation" 
                        label="Confirm Password" 
                        type="password" 
                        required 
                        placeholder="Confirm your password"
                        autocomplete="new-password"
                    />
                </div>

                <x-forms.button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Create Account
                </x-forms.button>
                
                <div class="text-center text-sm mt-4">
                    <p class="text-gray-600">
                        Already have an account? 
                        <a href="{{ route('intern.login') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Sign in
                        </a>
                    </p>
                </div>
            </x-forms.form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if jQuery is loaded
            if (typeof jQuery === 'undefined') {
                console.error('jQuery is not loaded');
                return;
            }

            // Initialize form validation
            $('#internRegisterForm').validate({
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
                        required: "Please enter your full name",
                        minlength: "Name must be at least 2 characters long"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Enter a valid email address"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
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