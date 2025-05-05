    <x-layout>
        <h1>Dashboard</h1>
        <h1>{{$user->name}}</h1>
    
        <x-forms.form method="POST" action="{{ route('admin.logout') }}" class="space-y-6">
                <x-forms.button>Logout</x-forms.button>
        </x-forms.form>
    </x-layout>