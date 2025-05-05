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
            
            <x-forms.form method="POST" action="{{ route('intern.register.submit') }}" class="space-y-6">
                <div class="space-y-5">
                    <x-forms.input 
                        name="name" 
                        label="Full Name" 
                        type="text" 
                        required 
                        placeholder="Enter your full name" 
                    />
                    
                    <x-forms.input 
                        name="email" 
                        label="Email Address" 
                        type="email" 
                        required 
                        placeholder="Enter your email" 
                    />
                    
                    <x-forms.input 
                        name="password" 
                        label="Password" 
                        type="password" 
                        required 
                        placeholder="Create a password" 
                    />
                    
                    <x-forms.input 
                        name="password_confirmation" 
                        label="Confirm Password" 
                        type="password" 
                        required 
                        placeholder="Confirm your password" 
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
</x-layout> 