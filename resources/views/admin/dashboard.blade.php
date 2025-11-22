@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <h3 class="text-gray-600 font-medium text-sm mb-1">
                Total Pesanan
                <span class="block text-xs text-blue-600">Saat ini</span>
            </h3>
            <p class="text-4xl font-bold text-gray-800 mt-2">{{ $orderCount ?? 0 }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <h3 class="text-gray-600 font-medium text-sm mb-1">
                Total Pengguna
                <span class="block text-xs text-blue-600">Saat ini</span>
            </h3>
            <p class="text-4xl font-bold text-gray-800 mt-2">{{ $userCount ?? 0 }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <h3 class="text-gray-600 font-medium text-sm mb-1">
                Total Menu
                <span class="block text-xs text-blue-600">Saat ini</span>
            </h3>
            <p class="text-4xl font-bold text-gray-800 mt-2">{{ $productCount ?? 0 }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <h3 class="text-gray-600 font-medium text-sm mb-1">
                Total Kategori
                <span class="block text-xs text-blue-600">Saat ini</span>
            </h3>
            <p class="text-4xl font-bold text-gray-800 mt-2">{{ $categoryCount ?? 0 }}</p>
        </div>
    </div>

    {{-- Tabel Pesanan --}}
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-x-auto">
        <div class="border-b border-gray-200 px-6 py-3 font-semibold text-gray-800 text-center">
            Pesanan Menunggu Konfirmasi & Sedang Diproses
        </div>

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
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if ($order->status == 'Selesai') bg-green-100 text-green-600
                                        @elseif($order->status == 'Dibatalkan') bg-red-100 text-red-600
                                        @elseif($order->status == 'Sedang Diproses') bg-blue-100 text-blue-600
                                        @else bg-yellow-100 text-yellow-600 @endif">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center flex justify-center gap-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                class="text-blue-600 hover:underline">Detail</a>

                            {{-- Form Update Status --}}
                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            </form>

                            {{-- Hapus --}}
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                onsubmit="return confirm('Yakin mau hapus pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 text-sm hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada pesanan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
