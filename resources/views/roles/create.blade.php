@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div class="mb-5">
            <label class="font-semibold">Role Name</label>

            <input type="text"
                   name="name"
                   class="w-full border rounded-lg p-3 mt-2">
        </div>

        @foreach($permissions as $module => $modulePermissions)

            <div class="mb-6 border rounded-lg p-4">

                <h3 class="font-bold text-lg capitalize mb-4">
                    {{ $module }}
                </h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

                    @foreach($modulePermissions as $permission)

                        <label class="flex items-center gap-2">

                            <input type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permission->name }}">

                            {{ $permission->name }}

                        </label>

                    @endforeach

                </div>

            </div>

        @endforeach

        <button class="bg-blue-600 text-white px-5 py-3 rounded-lg">
            Save Role
        </button>

    </form>

</div>

@endsection