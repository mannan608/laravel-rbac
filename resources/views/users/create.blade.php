@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Create User
            </h1>

            <p class="text-gray-500 mt-1">
                Create a new user and assign roles & permissions
            </p>
        </div>

        <a href="{{ route('users.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-xl transition">
            Back
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('users.store') }}"
          method="POST"
          class="space-y-6">

        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Side -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Basic Info -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                    <h2 class="text-xl font-semibold mb-6">
                        Basic Information
                    </h2>

                    <!-- Name -->
                    <div class="mb-5">
                        <label class="block mb-2 font-medium text-gray-700">
                            Full Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Enter full name"
                               class="w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3">

                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-5">
                        <label class="block mb-2 font-medium text-gray-700">
                            Email Address
                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Enter email address"
                               class="w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3">

                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Password
                        </label>

                        <input type="password"
                               name="password"
                               placeholder="Enter password"
                               class="w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3">

                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Direct Permissions -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold">
                            Direct Permissions
                        </h2>

                        <span class="text-sm text-gray-500">
                            Optional extra permissions
                        </span>
                    </div>

                    @php
                        $groupedPermissions = $permissions->groupBy(function ($item) {
                            return explode('.', $item->name)[0];
                        });
                    @endphp

                    <div class="space-y-6">

                        @foreach($groupedPermissions as $module => $modulePermissions)

                            <div class="border border-gray-200 rounded-xl p-5">

                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold capitalize text-gray-700">
                                        {{ $module }}
                                    </h3>

                                    <button type="button"
                                            onclick="toggleModulePermissions('{{ $module }}')"
                                            class="text-sm text-blue-600 hover:text-blue-800">
                                        Select All
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

                                    @foreach($modulePermissions as $permission)

                                        <label class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer">

                                            <input type="checkbox"
                                                   class="rounded border-gray-300 permission-group-{{ $module }}"
                                                   name="permissions[]"
                                                   value="{{ $permission->name }}"
                                                   @checked(in_array($permission->name, old('permissions', [])))>

                                            <span class="text-sm text-gray-700">
                                                {{ $permission->name }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

            <!-- Right Side -->
            <div class="space-y-6">

                <!-- Assign Roles -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                    <h2 class="text-xl font-semibold mb-6">
                        Assign Roles
                    </h2>

                    <div class="space-y-3">

                        @foreach($roles as $role)

                            <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer">

                                <input type="checkbox"
                                       name="roles[]"
                                       value="{{ $role->name }}"
                                       class="rounded border-gray-300"
                                       @checked(in_array($role->name, old('roles', [])))>

                                <div>
                                    <p class="font-medium text-gray-800">
                                        {{ $role->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $role->permissions->count() }} permissions
                                    </p>
                                </div>

                            </label>

                        @endforeach

                    </div>

                </div>

                <!-- Submit -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition duration-200">

                        Create User

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<script>
function toggleModulePermissions(module)
{
    const checkboxes = document.querySelectorAll('.permission-group-' + module);

    const allChecked = [...checkboxes].every(cb => cb.checked);

    checkboxes.forEach(cb => {
        cb.checked = !allChecked;
    });
}
</script>

@endsection
