<div>
    <label for="name" class="block font-semibold mb-2">Product Name</label>
    <input id="name"
           type="text"
           name="name"
           value="{{ old('name', $product?->name) }}"
           class="w-full border rounded-lg p-3">

    @error('name')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="price" class="block font-semibold mb-2">Price</label>
    <input id="price"
           type="number"
           step="0.01"
           min="0"
           name="price"
           value="{{ old('price', $product?->price) }}"
           class="w-full border rounded-lg p-3">

    @error('price')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="description" class="block font-semibold mb-2">Description</label>
    <textarea id="description"
              name="description"
              rows="4"
              class="w-full border rounded-lg p-3">{{ old('description', $product?->description) }}</textarea>

    @error('description')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
