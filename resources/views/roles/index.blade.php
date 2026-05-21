@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Role Management
            </h1>

            <p class="text-gray-500 mt-1">
                Manage user roles and permissions
            </p>
        </div>

        @can('roles.create')
        <a href="{{ route('roles.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow-sm transition">

            + Create Role

        </a>
        @endcan

    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Role Name
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Permissions
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Users
                        </th>

                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($roles as $role)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-5">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 font-bold">

                                        {{ strtoupper(substr($role->name,0,1)) }}

                                    </div>

                                    <div>

                                        <p class="font-semibold text-gray-800">
                                            {{ $role->name }}
                                        </p>

                                        <p class="text-sm text-gray-500">
                                            Created {{ $role->created_at->diffForHumans() }}
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-5">

                                <div class="flex flex-wrap gap-2">

                                    @foreach($role->permissions->take(4) as $permission)

                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">

                                            {{ $permission->name }}

                                        </span>

                                    @endforeach

                                    @if($role->permissions->count() > 4)

                                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs">

                                            +{{ $role->permissions->count() - 4 }} more

                                        </span>

                                    @endif

                                </div>

                            </td>

                            <td class="px-6 py-5">

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">

                                    {{ $role->users_count }} Users

                                </span>

                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-3">

                                    @can('roles.edit')
                                    <a href="{{ route('roles.edit', $role) }}"
                                       class="px-4 py-2 rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 text-sm font-medium transition">

                                        Edit

                                    </a>
                                    @endcan

                                    @can('roles.delete')
                                    <form action="{{ route('roles.destroy', $role) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-4 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 text-sm font-medium transition">

                                            Delete

                                        </button>

                                    </form>
                                    @endcan

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">

                                No roles found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="p-5 border-t border-gray-100">
            {{ $roles->links() }}
        </div>

    </div>

</div>

@endsection
