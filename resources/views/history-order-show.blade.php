@extends('layouts.app')
@section('title', 'Detail Pesanan')

@section('content')

<div class="max-w-6xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between bg-white shadow-md rounded-xl px-6 py-4 mb-6">
        <div class="flex items-center gap-4">
            <img src="{{ asset('images/logo.png') }}" alt="Makandulu" class="h-12">
        </div>

        <h1 class="text-3xl font-bold text-gray-800 text-center flex-1">
            History Detail
        </h1>

        <div class="w-35"></div>
    </div>

<div class="max-w-5xl mx-auto mt-6 p-6 bg-white shadow-lg rounded-2xl border border-gray-100">    
    {{-- Tombol Kembali --}}
    <a href="{{ route('profile') }}"
       class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium mb-6">
        <img src="{{ asset('images/back.png') }}" alt="Kembali" class="w-5 h-5 opacity-80">
        Kembali ke Profil
    </a>

    {{-- Header --}}
    <h2 class="text-2xl font-bold text-gray-800 mb-1">
        Pesanan #MD{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
    </h2>
    <p class="text-sm text-gray-500 mb-6">
        Dibuat pada {{ $order->created_at->format('d M Y, H:i') }}
    </p>

    {{-- Info Pelanggan & Pembayaran --}}
    <div class="grid md:grid-cols-2 gap-6 mb-8 text-sm">
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
                    Rp {{ number_format($order->total_price,0,',','.') }}
                </span>
            </p>
            <p><span class="font-semibold">Status:</span>
                <span class="px-2 py-1 text-xs font-semibold rounded-full
                    @if($order->status == 'Selesai') bg-green-100 text-green-600
                    @elseif($order->status == 'Dibatalkan') bg-red-100 text-red-600
                    @elseif($order->status == 'Sedang Diproses') bg-blue-100 text-blue-600
                    @else bg-yellow-100 text-yellow-600 @endif">
                    {{ $order->status }}
                </span>
            </p>
        </div>
    </div>

    {{-- Daftar Produk --}}
    @if($order->items && $order->items->count())
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
                        @foreach($order->items as $item)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="py-3 px-4">{{ $item->product->name ?? '-' }}</td>
                                <td class="py-3 px-4 text-center">{{ $item->quantity }}</td>
                                <td class="py-3 px-4 text-right">Rp {{ number_format($item->price,0,',','.') }}</td>
                                <td class="py-3 px-4 text-right font-medium text-gray-800">
                                    Rp {{ number_format($item->price * $item->quantity,0,',','.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50 border-t">
                        <tr>
                            <td colspan="3" class="py-3 px-4 text-right font-semibold text-gray-700">Total</td>
                            <td class="py-3 px-4 text-right font-bold text-gray-800">
                                Rp {{ number_format($order->total_price,0,',','.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @endif

    {{-- Catatan --}}
    <div class="mb-6">
        <h3 class="font-semibold text-gray-700 text-lg mb-2">Catatan</h3>
        <div class="p-4 bg-gray-50 rounded-lg border text-gray-700">
            {{ $order->notes ?? 'Tidak ada catatan dari pelanggan.' }}
        </div>
    </div>

</div>
@endsection
