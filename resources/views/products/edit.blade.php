@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Product</h1>
            <p class="text-gray-500 mt-1">Update product details</p>
        </div>

        <a href="{{ route('products.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-xl transition">
            Back
        </a>
    </div>

    <form action="{{ route('products.update', $product) }}" method="POST" class="bg-white rounded-xl shadow p-6 space-y-5">
        @csrf
        @method('PUT')

        @include('products.form', ['product' => $product])

        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">
            Update Product
        </button>
    </form>
</div>

@endsection
