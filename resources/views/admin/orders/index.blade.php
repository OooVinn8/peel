@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="p-6 min-h-screen">

    {{-- Statistik Pesanan --}}
    <div class="flex flex-wrap gap-6 mb-6">
        {{-- Card Pesanan Baru --}}
        <div class="flex-1 min-w-[250px] bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-600 font-medium text-sm mb-1">
                Pesanan Baru <span class="block text-xs text-gray-400">Hari ini</span>
            </h3>
            <p class="text-4xl font-bold text-gray-800 mt-2">{{ $newOrders ?? 0 }}</p>
        </div>

        {{-- Card Pesanan Menunggu Konfirmasi --}}
        <div class="flex-1 min-w-[250px] bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-600 font-medium text-sm mb-1">
                Menunggu Konfirmasi <span class="block text-xs text-gray-400">Belum diproses</span>
            </h3>
            <p class="text-4xl font-bold text-gray-800 mt-2">{{ $waitingCount ?? 0 }}</p>
        </div>
    </div>

    {{-- Search --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="relative w-full sm:w-1/2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Pelanggan..."
                class="w-full border border-gray-300 rounded-[100px] py-2 pl-10 pr-4 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
            <img src="{{ asset('images/search.png') }}" alt="Search"
                class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 opacity-70">
        </form>
    </div>

    {{-- Tabel Pesanan --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full bg-white text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700 border-b border-gray-200">
                <tr>
                    <th class="py-3 px-4 font-semibold text-sm">No</th>
                    <th class="py-3 px-4 font-semibold text-sm">Nama Pelanggan</th>
                    <th class="py-3 px-4 font-semibold text-sm">Tanggal Pemesanan</th>
                    <th class="py-3 px-4 font-semibold text-sm">Total</th>
                    <th class="py-3 px-4 font-semibold text-sm">Status</th>
                    <th class="py-3 px-4 font-semibold text-sm text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800">
                @forelse ($orders as $index => $order)
                    <tr class="border-b last:border-b-0">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">{{ $order->customer_name }}</td>
                        <td class="py-3 px-4 text-gray-600">
                            {{ $order->created_at->translatedFormat('d M Y, H:i') }}
                        </td>
                        <td class="py-3 px-4">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-600">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class="text-blue-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada pesanan menunggu konfirmasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
