@extends('layouts.admin')
@section('title', 'Detail Pesanan')

@section('content')
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-2xl border border-gray-100 p-8">

        {{-- Header & Tombol Kembali --}}
        <div class="mb-8">

            {{-- Tombol Kembali pindah ke atas --}}
            <a href="{{ route('admin.orders.index') }}"
                class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition mb-4">
                <img src="{{ asset('images/back.png') }}" alt="Kembali" class="w-5 h-5 opacity-80">
                <span>Kembali ke Daftar Pesanan</span>
            </a>

            <h2 class="text-2xl font-bold text-gray-800">
                Detail Pesanan #MD{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Dibuat pada {{ $order->created_at->format('d M Y, H:i') }}
            </p>
        </div>

        {{-- Informasi Pelanggan & Pembayaran --}}
        <div class="grid md:grid-cols-2 gap-6 text-sm mb-8">
            <div class="space-y-2">
                <h3 class="font-semibold text-gray-700 text-lg">Informasi Pelanggan</h3>
                <p><span class="font-semibold">Nama:</span> {{ $order->customer_name }}</p>
                <p><span class="font-semibold">Email:</span> {{ $order->user->email ?? '-' }}</p>
                <p><span class="font-semibold">Telepon:</span> {{ $order->customer_phone }}</p>
                <p><span class="font-semibold">Alamat:</span> {{ $order->customer_address }}</p>
            </div>

            <div class="space-y-2">
                <h3 class="font-semibold text-gray-700 text-lg">Detail Pembayaran</h3>
                <p><span class="font-semibold">Metode:</span> {{ ucfirst($order->payment_method) }}</p>
                <p><span class="font-semibold">Total:</span>
                    <span class="font-semibold text-gray-800">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                </p>
                <p><span class="font-semibold">Status:</span>
                    <span
                        class="
                    px-2 py-1 text-xs font-semibold rounded-full
                    @if (strtolower($order->status) == 'selesai') bg-green-100 text-green-600
                    @elseif(strtolower($order->status) == 'menunggu konfirmasi') bg-yellow-100 text-yellow-600
                    @elseif(strtolower($order->status) == 'sedang diproses') bg-blue-100 text-blue-600
                    @elseif(strtolower($order->status) == 'dibatalkan') bg-red-100 text-red-600 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
            </div>
        </div>

        {{-- Daftar Item Pesanan --}}
        @if (isset($order->items) && count($order->items) > 0)
            <div class="mb-8">
                <h3 class="font-semibold text-gray-700 text-lg mb-4">Daftar Produk</h3>
                <div class="overflow-x-auto border rounded-xl">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-50 border-b text-gray-600">
                            <tr>
                                <th class="py-3 px-4 text-left">Produk</th>
                                <th class="py-3 px-4 text-center">Kuantitas</th>
                                <th class="py-3 px-4 text-right">Harga</th>
                                <th class="py-3 px-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr class="border-b">
                                    <td class="py-3 px-4">{{ $item->product->name ?? '-' }}</td>
                                    <td class="py-3 px-4 text-center">{{ $item->quantity }}</td>
                                    <td class="py-3 px-4 text-right">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4 text-right font-medium text-gray-800">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 border-t">
                            <tr>
                                <td colspan="3" class="py-3 px-4 text-right font-semibold text-gray-700">Total</td>
                                <td class="py-3 px-4 text-right font-bold text-gray-800">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endif

        {{-- Catatan --}}
        <div class="mb-8">
            <h3 class="font-semibold text-gray-700 text-lg mb-2">Catatan</h3>
            <div class="p-4 bg-gray-50 rounded-lg border text-gray-700">
                {{ $order->notes ?? 'Tidak ada catatan dari pelanggan.' }}
            </div>
        </div>

        {{-- Aksi: Konfirmasi / Batalkan / Selesaikan --}}
        @if (!in_array(strtolower($order->status), ['selesai']))
            <div class="border-t pt-6">
                <h3 class="font-semibold text-gray-700 text-lg mb-4">Tindakan</h3>

                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex flex-wrap gap-3">
                    @csrf
                    @method('PUT')

                    {{-- Tombol Konfirmasi --}}
                    @if (in_array(strtolower($order->status), ['menunggu konfirmasi', 'dibatalkan']))
                        <button type="submit" name="status" value="sedang diproses"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition">
                            Konfirmasi
                        </button>
                    @endif

                    {{-- Tombol Batalkan --}}
                    @if (strtolower($order->status) == 'menunggu konfirmasi')
                        <button type="submit" name="status" value="dibatalkan"
                            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold transition">
                            Batalkan
                        </button>
                    @endif

                    {{-- Tombol Selesaikan Pesanan --}}
                    @if (in_array(strtolower($order->status), ['sedang diproses']))
                        <button type="submit" name="status" value="selesai"
                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg font-semibold transition">
                            Selesaikan Pesanan
                        </button>
                    @endif

                </form>
            </div>
        @endif


    </div>
@endsection
