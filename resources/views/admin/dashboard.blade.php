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


    {{-- Pesanan Masuk --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="border-b border-gray-200 px-6 py-3 font-semibold text-gray-800">
            Pesanan Masuk
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse">
                <thead>
                    <tr class="text-sm text-gray-600 border-b">
                        <th class="px-6 py-3 font-semibold">NO</th>
                        <th class="px-6 py-3 font-semibold">Tanggal</th>
                        <th class="px-6 py-3 font-semibold">Nama</th>
                        <th class="px-6 py-3 font-semibold">Catatan</th>
                        <th class="px-6 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @forelse ($orders as $index => $order)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-3">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">{{ date('d M Y', strtotime($order->created_at)) }}</td>
                            <td class="px-6 py-3">{{ $order->customer_name }}</td>
                            <td class="px-6 py-3 text-gray-600">{{ $order->notes ?? '-' }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('admin.orders.order-detail', $order->id) }}"
                                    class="text-blue-600 hover:underline">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-3 text-center text-gray-500">Belum ada pesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
