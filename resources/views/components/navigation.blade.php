<!-- resources/views/components/sidebar.blade.php -->
<aside class="w-64 h-screen bg-white shadow-md fixed">
    <div class="p-6 border-b">
        <h1 class="text-2xl font-bold">Interns Task Management</h1>
    </div>
    <nav class="p-4 space-y-2">
        <!-- Admin Links -->
        @if(Auth::guard('admin')->check())
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-200 font-semibold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 {{ request()->routeIs('admin.users') ? 'bg-indigo-200 font-semibold' : '' }}">
                Manage Users
            </a>
            <a href="{{ route('admin.tasks') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 {{ request()->routeIs('admin.tasks') ? 'bg-indigo-200 font-semibold' : '' }}">
                All Tasks
            </a>
        @endif

        <!-- Intern Links -->
        @if(Auth::guard('user')->check())
            <a href="{{ route('intern.dashboard') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 {{ request()->routeIs('intern.dashboard') ? 'bg-indigo-200 font-semibold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('intern.tasks') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 {{ request()->routeIs('intern.tasks') ? 'bg-indigo-200 font-semibold' : '' }}">
                My Tasks
            </a>
        @endif

        <!-- Logout -->
        <div class="mt-6">
            @if(Auth::guard('admin')->check())
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-100 rounded">
                        Logout
                    </button>
                </form>
            @elseif(Auth::guard('user')->check())
                <form method="POST" action="{{ route('intern.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-100 rounded">
                        Logout
                    </button>
                </form>
            @endif
        </div>
    </nav>
</aside>
