@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
    <div class="p-8">

        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.products.index') }}"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition mb-6">
            <img src="{{ asset('images/back.png') }}" alt="Kembali" class="w-5 h-5 opacity-80">
            <span>Kembali ke Daftar Produk</span>
        </a>

        {{-- Konten Utama --}}
        <div class="flex flex-col sm:flex-row items-start gap-8">

            {{-- Gambar Produk --}}
            <div class="flex-shrink-0">
                @php
                    $categoryName = $product->category->name ?? 'Umum';
                    $imagePath = 'image_menu/' . $categoryName . '/' . $product->image;
                @endphp

                @if ($product->image && file_exists(public_path($imagePath)))
                    <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}"
                        class="w-100 h-100 object-cover rounded-xl shadow-sm border border-gray-200">
                @else
                    <div
                        class="w-64 h-64 flex items-center justify-center bg-gray-100 rounded-xl text-gray-400 text-sm italic border border-gray-200">
                        Tidak ada gambar
                    </div>
                @endif
            </div>

            {{-- Info Produk --}}
            <div class="flex-1 space-y-4">
                <h2 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h2>

                <p class="text-gray-500 text-sm">
                    Kategori:
                    <span class="text-gray-700 font-medium">{{ $product->category->name ?? '-' }}</span>
                </p>

                <p class="text-2xl font-semibold text-blue-600">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                </p>

                <div class="flex items-center gap-6 text-sm text-gray-700">
                    <p>
                        <span class="font-medium">Stok:</span>
                        <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600 font-medium' }}">
                            {{ $product->stock > 0 ? $product->stock : 'Habis' }}
                        </span>
                    </p>
                </div>

                {{-- Deskripsi Produk --}}
                <div class="pt-4">
                    <h3 class="font-semibold text-gray-800 mb-2">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $product->description ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
