<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-blue-100 flex items-center justify-center rounded-full mb-6">
                    <svg class="h-10 w-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Welcome Back!</h2>
                <p class="text-sm text-gray-600 mb-8">
                    Sign in to your intern account to continue
                </p>
            </div>
            
            <x-forms.form method="POST" action="{{ route('intern.authenticate') }}" class="space-y-6">
                <div class="space-y-5">
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
                        placeholder="Enter your password" 
                        class="focus:ring-blue-500 focus:border-blue-500" 
                    />
                </div>

              

                <x-forms.button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Sign in to Account
                </x-forms.button>
            </x-forms.form>
        </div>
    </div>
</x-layout>