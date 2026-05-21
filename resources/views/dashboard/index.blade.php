@extends('layouts.app')


@section('content')


<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-gray-500">Users</h2>
        <p class="text-3xl font-bold">{{ $users }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-gray-500">Roles</h2>
        <p class="text-3xl font-bold">{{ $roles }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-gray-500">Permissions</h2>
        <p class="text-3xl font-bold">{{ $permissions }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-gray-500">Products</h2>
        <p class="text-3xl font-bold">{{ $products }}</p>
    </div>

</div>

@endsection