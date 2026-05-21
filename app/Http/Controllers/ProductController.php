<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:products.viewAny|products.view', only: ['index']),
            new Middleware('permission:products.create', only: ['create', 'store']),
            new Middleware('permission:products.edit', only: ['edit', 'update']),
            new Middleware('permission:products.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $products = Product::query()
            ->when(! Auth::user()->can('products.viewAny'), fn ($query) => $query->whereBelongsTo(Auth::user()))
            ->latest()
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->safe()->merge([
            'user_id' => Auth::id(),
        ])->all());

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created');
    }

    public function edit(Product $product)
    {
        $this->authorizeProductAccess($product);

        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorizeProductAccess($product);

        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $this->authorizeProductAccess($product);

        $product->delete();

        return back()->with('success', 'Product deleted');
    }

    private function authorizeProductAccess(Product $product): void
    {
        abort_unless(
            Auth::user()->can('products.viewAny') || $product->user_id === Auth::id(),
            403
        );
    }
}
