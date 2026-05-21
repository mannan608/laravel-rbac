@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center min-h-[80vh]">

    <div class="bg-white shadow-xl rounded-2xl p-10 text-center max-w-lg">

        <h1 class="text-6xl font-bold text-red-500">
            403
        </h1>

        <h2 class="text-2xl font-bold mt-4">
            Access Denied
        </h2>

        <p class="text-gray-500 mt-3">
            You do not have permission to access this page.
        </p>

        <a href="{{ route('dashboard') }}"
           class="inline-block mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg">
            Back Dashboard
        </a>

    </div>

</div>

@endsection