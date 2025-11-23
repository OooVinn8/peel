@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')

    {{-- Header & Tombol Kembali --}}
    <div class="max-w-4xl mx-auto flex items-center justify-between mb-8">
        <a href="{{ route('admin.products.index') }}"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition">
            <img src="{{ asset('images/back.png') }}" alt="Kembali" class="w-5 h-5 opacity-80">
            <span>Kembali ke Daftar Produk</span>
        </a>
    </div>

    {{-- Form Edit Produk --}}
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-md border border-gray-100">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            id="product-form">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Nama Produk --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                    <select name="category_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="text" id="price" name="price"
                        value="{{ number_format(old('price', $product->price), 0, ',', '.') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                </div>

                {{-- Stok --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                </div>

                {{-- Rating --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Rating</label>
                    <input type="number" name="rating" step="0.1" min="0" max="5"
                        value="{{ old('rating', $product->rating) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                {{-- Rekomendasi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Rekomendasi</label>
                    <select name="is_recommendation"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="1" {{ $product->is_recommendation ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ !$product->is_recommendation ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" rows="5"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Tulis deskripsi produk...">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Gambar Produk --}}
            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Produk</label>
                <div class="flex items-center gap-6">
                    @if ($product->image)
                        <img src="{{ asset('image_menu/' . $product->category->name . '/' . $product->image) }}"
                            alt="Gambar Produk" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                    @else
                        <div
                            class="w-32 h-32 flex items-center justify-center bg-gray-100 border border-gray-200 rounded-lg text-gray-400 text-sm italic">
                            Tidak ada gambar
                        </div>
                    @endif

                    <input type="file" name="image"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <p class="text-xs text-gray-500 mt-1">Upload gambar baru jika ingin mengganti.</p>
            </div>

            {{-- Tombol Submit --}}
            <div class="mt-8 flex justify-end">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
