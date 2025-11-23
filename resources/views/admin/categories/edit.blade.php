@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')

    <div class="max-w-4xl mx-auto flex items-center justify-between mb-8">
        <a href="{{ route('admin.categories.index') }}"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition">
            <img src="{{ asset('images/back.png') }}" alt="Kembali" class="w-5 h-5 opacity-80">
            <span>Kembali ke Daftar Kategori</span>
        </a>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-md border border-gray-100">

        <h2 class="text-xl font-semibold mb-6 text-gray-800">Edit Kategori</h2>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="name" value="{{ $category->name }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 
                           focus:ring-blue-400 focus:outline-none">
                </div>

                {{-- Gambar Lama --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar Saat Ini</label>
                    <img src="{{ asset('image_category/' . $category->image) }}"
                        class="w-40 h-40 object-cover rounded-lg border shadow">
                </div>

                {{-- Upload Baru --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Ganti Gambar (Opsional)</label>

                    <input type="file" name="image" accept="image/png"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white 
                           focus:ring-2 focus:ring-blue-400 focus:outline-none">

                    <p class="text-xs text-gray-500 mt-1">*Hanya PNG</p>
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}"
                    class="px-6 py-2 rounded-lg border text-gray-700 hover:bg-gray-100 transition">
                    Batal
                </a>

                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                    Update
                </button>
            </div>

        </form>
    </div>

@endsection
