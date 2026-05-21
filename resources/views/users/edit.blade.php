@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit User</h1>
            <p class="text-gray-500 mt-1">Update user details, roles, and direct permissions</p>
        </div>

        <a href="{{ route('users.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-xl transition">
            Back
        </a>
    </div>

    <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold mb-6">Basic Information</h2>

                    <div class="mb-5">
                        <label for="name" class="block mb-2 font-medium text-gray-700">Full Name</label>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3">
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block mb-2 font-medium text-gray-700">Email Address</label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3">
                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block mb-2 font-medium text-gray-700">Password</label>
                        <input id="password"
                               type="password"
                               name="password"
                               placeholder="Leave blank to keep current password"
                               class="w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3">
                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold mb-6">Direct Permissions</h2>

                    @php
                        $selectedPermissions = old('permissions', $user->getDirectPermissions()->pluck('name')->toArray());
                        $groupedPermissions = $permissions->groupBy(fn ($item) => explode('.', $item->name)[0]);
                    @endphp

                    <div class="space-y-6">
                        @foreach($groupedPermissions as $module => $modulePermissions)
                            <div class="border border-gray-200 rounded-xl p-5">
                                <h3 class="text-lg font-semibold capitalize text-gray-700 mb-4">{{ $module }}</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                                    @foreach($modulePermissions as $permission)
                                        <label class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer">
                                            <input type="checkbox"
                                                   name="permissions[]"
                                                   value="{{ $permission->name }}"
                                                   class="rounded border-gray-300"
                                                   @checked(in_array($permission->name, $selectedPermissions))>
                                            <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold mb-6">Assign Roles</h2>

                    @php
                        $selectedRoles = old('roles', $user->roles->pluck('name')->toArray());
                    @endphp

                    <div class="space-y-3">
                        @foreach($roles as $role)
                            <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox"
                                       name="roles[]"
                                       value="{{ $role->name }}"
                                       class="rounded border-gray-300"
                                       @checked(in_array($role->name, $selectedRoles))>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $role->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $role->permissions->count() }} permissions</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition duration-200">
                        Update User
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
