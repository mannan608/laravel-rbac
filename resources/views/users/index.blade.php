@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow">

    <div class="p-5 border-b flex justify-between">

        <h2 class="text-2xl font-bold">Users</h2>

        @can('users.create')
        <a href="{{ route('users.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Add User
        </a>
        @endcan

    </div>

    <table class="w-full">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-4 text-left">Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Permissions</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($users as $user)

            <tr class="border-t">

                <td class="p-4">{{ $user->name }}</td>

                <td>{{ $user->email }}</td>

                <td>
                    @foreach($user->roles as $role)
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">
                            {{ $role->name }}
                        </span>
                    @endforeach
                </td>

                <td>
                    {{ $user->getDirectPermissions()->count() }}
                </td>

                <td class="space-x-2">

                    @can('users.edit')
                    <a href="{{ route('users.edit', $user) }}"
                       class="text-blue-600">
                        Edit
                    </a>
                    @endcan

                    @can('users.delete')
                    <form action="{{ route('users.destroy', $user) }}"
                          method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-600">
                            Delete
                        </button>
                    </form>
                    @endcan

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="p-5">
        {{ $users->links() }}
    </div>

</div>

@endsection