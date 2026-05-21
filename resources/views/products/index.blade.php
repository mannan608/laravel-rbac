@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow">
    <div class="p-5 border-b flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Products</h1>
            <p class="text-gray-500 mt-1">Manage product records</p>
        </div>

        @can('products.create')
        <a href="{{ route('products.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Add Product
        </a>
        @endcan
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Price</th>
                    <th class="p-4 text-left">Description</th>
                    <th class="p-4 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)
                    <tr class="border-t">
                        <td class="p-4 font-medium text-gray-800">{{ $product->name }}</td>
                        <td class="p-4">{{ number_format($product->price, 2) }}</td>
                        <td class="p-4 text-gray-600">{{ $product->description ?: 'N/A' }}</td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-3">
                                @can('products.edit')
                                <a href="{{ route('products.edit', $product) }}"
                                   class="px-4 py-2 rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 text-sm font-medium transition">
                                    Edit
                                </a>
                                @endcan

                                @can('products.delete')
                                <form action="{{ route('products.destroy', $product) }}"
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
                        <td colspan="4" class="p-8 text-center text-gray-500">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-5 border-t">
        {{ $products->links() }}
    </div>
</div>

@endsection
