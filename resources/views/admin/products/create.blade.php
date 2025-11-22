@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
    {{-- Header & Tombol Kembali --}}
    <div class="max-w-4xl mx-auto flex items-center justify-between mb-8">
        <a href="{{ route('admin.products.index') }}"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition">
            <img src="{{ asset('images/back.png') }}" alt="Kembali" class="w-5 h-5 opacity-80">
            <span>Kembali ke Daftar Produk</span>
        </a>
    </div>

    {{-- Form Create Produk --}}
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-md border border-gray-100">
        <form id="product-form" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Nama Produk --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name') }}"
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
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required step="50" min="0">
                </div>

                {{-- Stok --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                </div>

                {{-- Rekomendasi (nullable) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Rekomendasi (Opsional)</label>
                    <select name="is_recommendation"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="1" {{ old('is_recommendation') == 1 ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ old('is_recommendation') == 0 ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" rows="5"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Tulis deskripsi produk...">{{ old('description') }}</textarea>
            </div>

            {{-- Gambar Produk --}}
            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Produk</label>
                <input type="file" name="image" required
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <p class="text-xs text-gray-500 mt-1">Upload gambar produk (maks 2MB).</p>
            </div>  

            {{-- Tombol Submit --}}
            <div class="mt-8 flex justify-end">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                    Tambah Produk
                </button>
            </div>
        </form>
    </div>


@endsection
