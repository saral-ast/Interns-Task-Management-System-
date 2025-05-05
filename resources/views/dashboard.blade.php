<x-layout>
    <x-navigation>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Welcome, {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : Auth::guard('user')->user()->name }}!</h2>
            <p class="text-gray-600">Here you can manage your tasks and track your progress.</p>
            
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                    <h3 class="text-lg font-medium text-blue-800 mb-2">Active Tasks</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ Auth::guard('user')->check() ? Auth::user()->tasks()->where('status', 'pending')->orWhere('status', 'in_progress')->count() : 0 }}</p>
                </div>
                
                <div class="bg-green-50 p-6 rounded-lg border border-green-100">
                    <h3 class="text-lg font-medium text-green-800 mb-2">Completed Tasks</h3>
                    <p class="text-3xl font-bold text-green-600">{{ Auth::guard('user')->check() ? Auth::user()->tasks()->where('status', 'completed')->count() : 0 }}</p>
                </div>
                
                <div class="bg-purple-50 p-6 rounded-lg border border-purple-100">
                    <h3 class="text-lg font-medium text-purple-800 mb-2">Total Tasks</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ Auth::guard('user')->check() ? Auth::user()->tasks()->count() : 0 }}</p>
                </div>
            </div>
        </div>
    </x-navigation>
</x-layout>