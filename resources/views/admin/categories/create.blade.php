@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')

    <div class="max-w-4xl mx-auto flex items-center justify-between mb-8">
        <a href="{{ route('admin.categories.index') }}"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition">
            <img src="{{ asset('images/back.png') }}" alt="Kembali" class="w-5 h-5 opacity-80">
            <span>Kembali ke Daftar Kategori</span>
        </a>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-md border border-gray-100">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-6">

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama kategori..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                {{-- Upload Gambar --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar (PNG)</label>

                    <input type="file" name="image" id="imageInput" accept="image/png" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none">

                    {{-- Preview --}}
                    <img id="previewImage" class="mt-4 w-40 rounded-lg shadow hidden" alt="Preview">

                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                    Tambah Kategori
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            let file = e.target.files[0];
            let preview = document.getElementById('previewImage');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            }
        });
    </script>

@endsection
