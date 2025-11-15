@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">🛒 Checkout</h2>

    <div class="grid md:grid-cols-3 gap-8">
        {{-- Form Pengiriman --}}
        <div class="md:col-span-2 bg-white rounded-2xl shadow-lg p-8">
            <h3 class="text-xl font-semibold mb-6 text-gray-700">Informasi Pengiriman</h3>

            {{-- Pesan sukses / error --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-yellow-400 focus:border-yellow-400">
                        @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Alamat Lengkap</label>
                        <textarea name="address" rows="4" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-yellow-400 focus:border-yellow-400">{{ old('address') }}</textarea>
                        @error('address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-yellow-400 focus:border-yellow-400">
                        @error('phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Metode Pembayaran</label>
                        <select name="payment_method" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-yellow-400 focus:border-yellow-400">
                            <option value="">Pilih metode</option>
                            <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Bayar di Tempat (COD)</option>
                            <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="ewallet" {{ old('payment_method') == 'ewallet' ? 'selected' : '' }}>E-Wallet (OVO, GoPay, DANA)</option>
                        </select>
                        @error('payment_method')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Catatan (opsional)</label>
                        <textarea name="notes" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-yellow-400 focus:border-yellow-400">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <button type="submit"
                    class="mt-8 bg-yellow-500 hover:bg-yellow-600 transition w-full py-3 rounded-xl font-semibold text-white text-lg">
                    Konfirmasi & Bayar
                </button>
            </form>
        </div>

        {{-- Ringkasan Pesanan --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col justify-between h-fit">
            <div>
                <h3 class="text-xl font-semibold mb-5 text-gray-700">Ringkasan Pesanan</h3>
                @forelse($cartItems as $item)
                    <div class="flex justify-between mb-4 items-center border-b border-gray-100 pb-2">
                        <div>
                            <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">x{{ $item->quantity }}</p>
                        </div>
                        <p class="font-semibold text-gray-700">
                            Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500">Keranjangmu kosong.</p>
                @endforelse
            </div>

            @if($cartItems->count() > 0)
                <hr class="my-4 border-gray-200">
                <div class="flex justify-between font-semibold text-gray-800 text-lg">
                    <p>Total Pembayaran</p>
                    <p class="text-blue-600">
                        Rp{{ number_format($cartItems->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
