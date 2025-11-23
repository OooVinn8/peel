@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        {{-- Notifikasi sukses / error --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Header Keranjang --}}
        <div class="max-w-6xl mx-auto px-6 py-4 relative bg-white rounded-lg shadow mb-6 flex items-center">
            <div class="flex-shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Makandulu" class="h-12">
            </div>
            <h1 class="absolute left-1/2 transform -translate-x-1/2 text-3xl font-bold text-gray-800">
                Keranjang
            </h1>
        </div>

        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium mb-6">
            <img src="{{ asset('images/back.png') }}" alt="Kembali" class="w-5 h-5 opacity-80">
            Kembali ke Beranda
        </a>

        @if ($cartItems->count() > 0)
            <div class="overflow-hidden rounded-lg shadow bg-white">
                {{-- Header Kolom --}}
                <div
                    class="grid grid-cols-[2fr_1fr_1fr_1.2fr_1fr_60px] font-semibold text-white bg-blue-600 p-3 items-center">
                    <div>Produk</div>
                    <div class="text-center">Harga</div>
                    <div class="text-center">Kuantitas</div>
                    <div class="text-center">Total</div>
                    <div class="text-center">Aksi</div>
                </div>

                {{-- Daftar Produk --}}
                @foreach ($cartItems as $item)
                    <div
                        class="grid grid-cols-[2fr_1fr_1fr_1.2fr_1fr_60px] items-center border-b p-4 hover:bg-yellow-50 transition cart-row">

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
                            <div class="inline-flex items-center quantity-form" data-id="{{ $item->id }}"
                                data-stock="{{ $item->product->stock }}">

                                <button type="button"
                                    class="px-2 border rounded-l decrease-btn disabled:opacity-50 disabled:cursor-not-allowed"
                                    @if ($item->quantity <= 1) disabled @endif>−</button>

                                <span class="px-3 border-t border-b quantity">{{ $item->quantity }}</span>

                                <button type="button"
                                    class="px-2 border rounded-r increase-btn disabled:opacity-50 disabled:cursor-not-allowed"
                                    @if ($item->quantity >= $item->product->stock) disabled @endif>+</button>
                            </div>
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
                                    <img src="{{ asset('images/delete.png') }}" alt="Hapus"
                                        class="w-6 h-6 inline-block">
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                {{-- Footer Subtotal --}}
                <div class="p-4 bg-gray-50 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Keranjangmu siap, perutmu menanti! Setiap pilihanmu bakal bikin momen makan jadi lebih seru bareng
                        Makandulu.
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
                <a href="/menu" class="text-blue-500 hover:underline mt-3 inline-block">Belanja Sekarang</a>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection
