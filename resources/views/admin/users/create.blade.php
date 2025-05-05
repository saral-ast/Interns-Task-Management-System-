<x-layout>
    <x-navigation>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-medium text-gray-900">
                        Create New Intern
                    </h1>

                    <form method="POST" action="{{ route('admin.interns.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div class="space-y-4">
                            <label for="name" class="block font-medium text-base text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required autofocus />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-4">
                            <label for="email" class="block font-medium text-base text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required />
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-4">
                            <label for="password" class="block font-medium text-base text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required />
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-4">
                            <label for="password_confirmation" class="block font-medium text-base text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full text-base rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-3" required />
                        </div>

                        <input type="hidden" name="role_id" value="2">

                        <div class="flex items-center gap-6 mt-10">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Create Intern
                            </button>
                            <a href="{{ route('admin.interns') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
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