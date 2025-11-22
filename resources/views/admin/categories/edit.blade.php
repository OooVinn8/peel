@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')

<div class="max-w-lg mx-auto bg-white shadow-md rounded-xl p-6">

    <h2 class="text-xl font-semibold mb-6 text-gray-800">Edit Kategori</h2>

    <form action="{{ route('admin.categories.update', $category->id) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <label class="block text-gray-600 mb-2">Nama Kategori</label>
        <input type="text" name="name" value="{{ $category->name }}" required
               class="w-full border px-3 py-2 rounded-lg mb-5">

        {{-- Gambar Lama --}}
        <label class="block text-gray-600 mb-2">Gambar Saat Ini</label>
        <div class="w-28 h-28 mb-4">
            <img src="{{ asset('image_category/' . $category->image) }}" 
                 class="w-28 h-28 object-cover rounded-lg border">
        </div>

        {{-- Upload Baru --}}
        <label class="block text-gray-600 mb-2">Ganti Gambar (Opsional)</label>
        <input type="file" name="image" accept="image/png"
               class="w-full border px-3 py-2 rounded-lg">

        <p class="text-xs text-gray-500 mt-1">*Hanya PNG</p>

        <div class="flex justify-end mt-6 gap-3">
            <a href="{{ route('admin.categories.index') }}"
               class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">
                Batal
            </a>

            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Update
            </button>
        </div>

    </form>
</div>

@endsection
