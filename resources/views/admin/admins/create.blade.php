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

                        <x-forms.form method="POST" action="{{ route('admin.admins.store') }}" class="mt-6 space-y-6" id="adminCreateForm">
                            @csrf
                            <div class="space-y-4">
                                <x-forms.input 
                                    name="name" 
                                    label="Full Name" 
                                    type="text" 
                                    required 
                                    placeholder="Enter administrator name"
                                    value="{{ old('name') }}"
                                    autocomplete="name"
                                />
                                
                                <x-forms.input 
                                    name="email" 
                                    label="Email Address" 
                                    type="email" 
                                    required 
                                    placeholder="Enter administrator email"
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
                                    id="password"
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

                            <div class="space-y-4 mt-6">
                                <label class="block font-medium text-base text-gray-700">Permissions</label>

                                <!-- Select All Checkbox (unchecked by default) -->
                                <x-forms.checkbox 
                                    name="select_all" 
                                    value="1" 
                                    id="select_all_permissions"
                                    label="Select All Permissions"
                                />

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @foreach($permissions as $permission)
                                        <x-forms.checkbox 
                                            name="permissions[]" 
                                            value="{{ $permission->id }}" 
                                            id="permission_{{ $permission->id }}"
                                            label="{{ ucwords(str_replace('_', ' ', $permission->permission)) }}"
                                            class="permission-checkbox"
                                        />
                                    @endforeach
                                </div>
                            </div>

                            <input type="hidden" name="role_id" value="1">

                            <div class="flex items-center gap-6 mt-10">
                                <x-forms.button class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Create Administrator
                                </x-forms.button>
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

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof jQuery === 'undefined') {
                console.error('jQuery is not loaded');
                return;
            }

            // Form validation
            $('#adminCreateForm').validate({
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
                        required: "Please enter the administrator's name",
                        minlength: "Name must be at least 2 characters long"
                    },
                    email: {
                        required: "Please enter the administrator's email address",
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
                    const submitButton = $(form).find('button[type="submit"]');
                    submitButton.prop('disabled', true);
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

            // Select/Deselect all permissions
            $('#select_all_permissions').on('change', function () {
                const checked = $(this).is(':checked');
                $('.permission-checkbox').prop('checked', checked);
            });

            $(document).on('change', '.permission-checkbox', function () {
                const allChecked = $('.permission-checkbox').length === $('.permission-checkbox:checked').length;
                $('#select_all_permissions').prop('checked', allChecked);
            });
        });
    </script>
    @endpush
</x-layout>
