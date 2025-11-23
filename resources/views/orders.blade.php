@extends('layouts.app')
@section('title', 'Pesanan Saya')

@section('content')

    <div class="max-w-6xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between bg-white shadow-md rounded-xl px-6 py-4 mb-6">
        <div class="flex items-center gap-4">
            <img src="{{ asset('images/logo.png') }}" alt="Makandulu" class="h-12">
        </div>

        <h1 class="text-3xl font-bold text-gray-800 text-center flex-1">
            Pesanan Saya
        </h1>

        <div class="w-35"></div>
    </div>
    
    {{-- Tombol Kembali --}}
    <a href="{{ route('home') }}"
    class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium mb-6">
        <img src="{{ asset('images/back.png') }}" alt="Kembali" class="w-5 h-5 opacity-80">
        Kembali ke Beranda
    </a>

    @if($orders->count())
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">No</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Total</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($orders as $index => $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700 font-semibold">Rp {{ number_format($order->total_price,0,',','.') }}</td>
                            <td class="py-3 px-4 text-sm">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($order->status == 'Selesai') bg-green-100 text-green-700
                                    @elseif($order->status == 'Dibatalkan') bg-red-100 text-red-700
                                    @elseif($order->status == 'Sedang Diproses') bg-blue-100 text-blue-700
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('user.orders.show', $order->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                   Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white shadow rounded-xl p-6 text-center mt-6">
            <p class="text-gray-500 text-lg">Belum ada pesanan.</p>
        </div>
    @endif
</div>
@endsection
