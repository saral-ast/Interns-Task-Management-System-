<x-layout>
    <x-navigation>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <div class="flex text-center items-center mb-6">
                            <h1 class="text-2xl font-medium text-gray-900">
                                Create New Administrator
                            </h1>
                        </div>

                        <x-forms.form method="POST" action="{{ route('admin.admins.store') }}" class="mt-6 space-y-6">
                            <div class="space-y-4">
                                <x-forms.input 
                                    name="name" 
                                    label="Full Name" 
                                    type="text" 
                                    required 
                                    placeholder="Enter administrator name" 
                                />
                                
                                <x-forms.input 
                                    name="email" 
                                    label="Email Address" 
                                    type="email" 
                                    required 
                                    placeholder="Enter administrator email" 
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

                            <input type="hidden" name="role_id" value="1">

                            <div class="flex items-center gap-6 mt-10">
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Create Administrator
                                </button>
                                <a href="{{ route('admin.admins') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                                    Cancel
                                </a>
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </x-navigation>
</x-layout>