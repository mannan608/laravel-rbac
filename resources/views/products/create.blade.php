@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Create Product</h1>
            <p class="text-gray-500 mt-1">Add a new product</p>
        </div>

        <a href="{{ route('products.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-xl transition">
            Back
        </a>
    </div>

    <form action="{{ route('products.store') }}" method="POST" class="bg-white rounded-xl shadow p-6 space-y-5">
        @csrf

        @include('products.form', ['product' => null])

        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">
            Save Product
        </button>
    </form>
</div>

@endsection
