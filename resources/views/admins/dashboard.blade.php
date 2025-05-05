<x-layout>
    <x-navigation />
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Admin Dashboard</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-100 p-4 rounded">
                            <h4 class="font-bold">Total Users</h4>
                            <p class="text-2xl">{{ \App\Models\User::count() }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded">
                            <h4 class="font-bold">Total Tasks</h4>
                            <p class="text-2xl">{{ \App\Models\Task::count() }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded">
                            <h4 class="font-bold">Pending Tasks</h4>
                            <p class="text-2xl">{{ \App\Models\Task::where('status', 'pending')->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h4 class="font-bold mb-2">Quick Actions</h4>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.tasks.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Create New Task</a>
                            <a href="{{ route('admin.users.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add New User</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>