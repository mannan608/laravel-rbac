@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Role</h1>
            <p class="text-gray-500 mt-1">Update role name and permissions</p>
        </div>

        <a href="{{ route('roles.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-xl transition">
            Back
        </a>
    </div>

    <form action="{{ route('roles.update', $role) }}" method="POST" class="bg-white rounded-xl shadow p-6">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label for="name" class="block font-semibold mb-2">Role Name</label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name', $role->name) }}"
                   class="w-full border rounded-lg p-3">

            @error('name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        @foreach($permissions as $module => $modulePermissions)
            <div class="mb-6 border rounded-lg p-4">
                <h3 class="font-bold text-lg capitalize mb-4">{{ $module }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-3">
                    @foreach($modulePermissions as $permission)
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permission->name }}"
                                   @checked(in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())))>
                            {{ $permission->name }}
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button class="bg-blue-600 text-white px-5 py-3 rounded-lg">
            Update Role
        </button>
    </form>
</div>

@endsection
