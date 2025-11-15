@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
    <div class="p-6 min-h-screen">

        {{-- Dua Kartu Statistik --}}
        <div class="flex flex-wrap gap-6 mb-6">
            <div class="flex-1 min-w-[250px] bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-gray-600 font-medium text-sm mb-1">
                    Total Produk <span class="block text-xs text-gray-400">Saat ini</span>
                </h3>
                <p class="text-4xl font-bold text-gray-800 mt-2">{{ $totalProducts }}</p>
            </div>

            <div class="flex-1 min-w-[250px] bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-gray-600 font-medium text-sm mb-1">
                    Produk Rekomendasi <span class="block text-xs text-gray-400">Yang Ditampilkan</span>
                </h3>

                @if ($recommendedProducts->count() > 0)
                    <ul class="mt-3 space-y-1 text-sm text-gray-700 list-disc list-inside max-h-40 overflow-y-auto">
                        @foreach ($recommendedProducts as $product)
                            <li>{{ $product->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400 text-sm mt-2 italic">Belum ada produk rekomendasi.</p>
                @endif
            </div>
        </div>

        {{-- Search dan Tambah --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            {{-- Search --}}
            <form method="GET" action="{{ route('admin.products.index') }}" class="relative w-full sm:w-1/2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Produk..."
                    class="w-full border border-gray-300 rounded-[100px] py-2 pl-10 pr-4 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                <img src="{{ asset('images/search.png') }}" alt="Search"
                    class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 opacity-70">
            </form>

            {{-- Tombol Tambah --}}
            <a href="{{ route('admin.products.create') }}"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-[100px] shadow-sm transition">
                <span class="text-lg leading-none">＋</span>
                <span>Tambah Produk</span>
            </a>
        </div>

        {{-- Tabel Produk --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-4 font-semibold text-sm w-10">No</th>
                        <th class="py-3 px-4 font-semibold text-sm">Nama</th>
                        <th class="py-3 px-4 font-semibold text-sm">Kategori</th>
                        <th class="py-3 px-4 font-semibold text-sm">Harga</th>
                        <th class="py-3 px-4 font-semibold text-sm">Stok</th>
                        <th class="py-3 px-4 font-semibold text-sm text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @forelse($products as $index => $product)
                        <tr class="border-b last:border-b-0 hover:bg-gray-50 transition">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4">{{ $product->name }}</td>
                            <td class="py-3 px-4">{{ $product->category->name ?? '-' }}</td>
                            <td class="py-3 px-4">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">{{ $product->stock ?? 0 }}</td>
                            <td class="py-3 px-4 text-center space-x-3">
                                <a href="{{ route('admin.products.show', $product->id) }}"
                                    class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                    class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada produk terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
