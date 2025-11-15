@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    {{-- Header Keranjang --}}
    <div class="max-w-6xl mx-auto px-6 py-4 relative bg-white rounded-lg shadow mb-6 flex items-center">
        <div class="flex-shrink-0">
            <img src="{{ asset('images/logo.png') }}" alt="Makandulu" class="h-12">
        </div>
        <h1 class="absolute left-1/2 transform -translate-x-1/2 text-3xl font-bold text-gray-800">
            Keranjang 
        </h1>
    </div>

    @if ($cartItems->count() > 0)
        <div class="overflow-hidden rounded-lg shadow bg-white">
            {{-- Header kolom --}}
            <div class="grid grid-cols-[2fr_1fr_1fr_1.2fr_1fr_60px] font-semibold text-white bg-blue-600 p-3 items-center">
                <div>Produk</div>
                <div class="text-center">Harga</div>
                <div class="text-center">Kuantitas</div>
                <div class="text-center">Catatan</div>
                <div class="text-center">Total</div>
                <div class="text-center">Aksi</div>
            </div>

            {{-- Daftar produk --}}
            @foreach ($cartItems as $item)
                <div class="grid grid-cols-[2fr_1fr_1fr_1.2fr_1fr_60px] items-center border-b p-4 hover:bg-yellow-50 transition cart-row">

                    {{-- Produk --}}
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('image_menu/' . $item->product->category->name . '/' . $item->product->image) }}"
                             class="w-20 h-20 rounded-md object-cover" alt="{{ $item->product->name }}">
                        <div>
                            <h3 class="font-semibold text-lg">
                                <a href="{{ route('menu.menu-detail', $item->product->id) }}"
                                   class="text-gray-800 hover:text-yellow-600 transition">
                                    {{ $item->product->name }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $item->product->category->name ?? 'Tanpa Kategori' }}
                            </p>
                        </div>
                    </div>

                    {{-- Harga --}}
                    <div class="text-center">
                        <p class="font-semibold text-gray-700 unit-price" data-price="{{ $item->price }}">
                            Rp{{ number_format($item->price, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Kuantitas --}}
                    <div class="text-center">
                        <div class="inline-flex items-center quantity-form" data-id="{{ $item->id }}">
                            <button type="button" class="px-2 border rounded-l hover:bg-gray-200 decrease-btn">−</button>
                            <span class="px-3 border-t border-b quantity">{{ $item->quantity }}</span>
                            <button type="button" class="px-2 border rounded-r hover:bg-gray-200 increase-btn">+</button>
                        </div>
                    </div>

                    {{-- Catatan --}}
                    <div class="text-center">
                        <input type="text" name="note" value="{{ $item->note ?? '' }}"
                            placeholder="Tambahkan catatan..."
                            class="w-36 border rounded px-2 py-1 text-sm focus:outline-none focus:ring focus:ring-blue-200 text-center note-input"
                            data-id="{{ $item->id }}">
                    </div>

                    {{-- Total --}}
                    <div class="text-center font-semibold text-blue-600 item-total">
                        Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </div>

                    {{-- Hapus --}}
                    <div class="text-center">
                        <form action="{{ route('cart.delete', $item->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="focus:outline-none hover:opacity-80 transition">
                                <img src="{{ asset('images/delete.png') }}" alt="Hapus" class="w-6 h-6 inline-block">
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            {{-- Footer Subtotal --}}
            <div class="p-4 bg-gray-50 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Gratis Ongkir s/d 40rb dengan min. belanja Rp0; Gratis Ongkir s/d 200rb dengan min. belanja Rp300rb.
                </div>
                <div class="text-right">
                    <p class="text-gray-700">Subtotal:
                        <span class="font-bold text-lg text-blue-600" id="cart-subtotal">
                            Rp{{ number_format($cartItems->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
                        </span>
                    </p>
                    <a href="{{ route('checkout.index') }}"
                        class="mt-2 inline-block bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600 transition">
                        Lanjut ke Pembayaran
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white p-10 text-center rounded-lg shadow">
            <p class="text-gray-500 text-lg">Keranjangmu masih kosong</p>
            <a href="/" class="text-blue-500 hover:underline mt-3 inline-block">Belanja Sekarang</a>
        </div>
    @endif
</div>

@section('scripts')
<script src="{{ asset('js/cart.js') }}"></script>
@endsection
@endsection
