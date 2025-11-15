@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')
<div class="p-6 min-h-screen">

    {{-- Statistik --}}
    <div class="flex flex-wrap gap-6 mb-6">
        <div class="flex-1 min-w-[250px] bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-600 font-medium text-sm mb-1">
                Total Kategori <span class="block text-xs text-gray-400">Saat ini</span>
            </h3>
            <p class="text-4xl font-bold text-gray-800 mt-2">{{ $totalCategories }}</p>
        </div>

        <div class="flex-1 min-w-[250px] bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-600 font-medium text-sm mb-1">
                Kategori Baru <span class="block text-xs text-gray-400">Hari ini</span>
            </h3>
            <p class="text-4xl font-bold text-gray-800 mt-2">{{ $newCategories }}</p>
        </div>
    </div>

    {{-- Search & Tambah --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-5 gap-4">
        {{-- Search --}}
        <form method="GET" action="{{ route('admin.categories.index') }}" class="relative w-full sm:w-1/2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kategori..."
                class="w-full border border-gray-300 rounded-[100px] py-2 pl-10 pr-4 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
            <img src="{{ asset('images/search.png') }}" alt="Search"
                class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 opacity-70">
        </form>

        {{-- Tombol Tambah --}}
        <a href="{{ route('admin.categories.create') }}"
           class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-[100px] shadow-sm transition">
            <span class="text-lg leading-none">＋</span>
            <span>Tambah Kategori</span>
        </a>
    </div>

    {{-- Tabel Kategori --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full bg-white text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700 border-b border-gray-200">
                <tr>
                    <th class="py-2.5 px-3 font-semibold text-xs">No</th>
                    <th class="py-2.5 px-3 font-semibold text-xs">Nama Kategori</th>
                    <th class="py-2.5 px-3 font-semibold text-xs text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-[13px] text-gray-800">
                @forelse($categories as $index => $category)
                    <tr class="border-b last:border-b-0 hover:bg-gray-50 transition-colors">
                        <td class="py-2 px-3">{{ $index + 1 }}</td>
                        <td class="py-2 px-3">{{ $category->name }}</td>
                        <td class="py-2 px-3 text-center">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500 text-sm">
                            Tidak ada kategori terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
