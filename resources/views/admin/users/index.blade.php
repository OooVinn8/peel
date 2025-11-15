@extends('layouts.admin')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="p-6 min-h-screen">

    {{-- Statistik --}}
    <div class="flex flex-wrap gap-6 mb-6">
        <div class="flex-1 min-w-[250px] bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-600 font-medium text-sm mb-1">
                Total Pengguna <span class="block text-xs text-gray-400">Saat ini</span>
            </h3>
            <p class="text-4xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</p>
        </div>

        <div class="flex-1 min-w-[250px] bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-600 font-medium text-sm mb-1">
                Pengguna Baru <span class="block text-xs text-gray-400">Hari ini</span>
            </h3>
            <p class="text-4xl font-bold text-gray-800 mt-2">{{ $newUsers }}</p>
        </div>
    </div>

    {{-- Search & Tambah --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-5 gap-4">
        {{-- Search --}}
        <form method="GET" action="{{ route('admin.users.index') }}" class="relative w-full sm:w-1/2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Pembeli..."
                class="w-full border border-gray-300 rounded-[100px] py-2 pl-10 pr-4 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
            <img src="{{ asset('images/search.png') }}" alt="Search"
                class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 opacity-70">
        </form>
    </div>

    {{-- Tabel Pembeli --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full bg-white text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700 border-b border-gray-200">
                <tr>
                    <th class="py-2.5 px-3 font-semibold text-xs">No</th>
                    <th class="py-2.5 px-3 font-semibold text-xs">Foto</th>
                    <th class="py-2.5 px-3 font-semibold text-xs">Username</th>
                    <th class="py-2.5 px-3 font-semibold text-xs">Email</th>
                    <th class="py-2.5 px-3 font-semibold text-xs">No Telepon</th>
                    <th class="py-2.5 px-3 font-semibold text-xs">Tanggal Daftar</th>
                    <th class="py-2.5 px-3 font-semibold text-xs text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-[13px] text-gray-800">
                @forelse ($users as $index => $user)
                    <tr class="border-b last:border-b-0 hover:bg-gray-50 transition-colors">
                        <td class="py-2 px-3">{{ $index + 1 }}</td>

                        {{-- Foto Profil --}}
                        <td class="py-2 px-3">
                            <img src="{{ $user->profile_picture 
                                ? asset('uploads/profile_pictures/' . $user->profile_picture) 
                                : asset('uploads/profile_pictures/default.jpg') }}"
                                 alt="Foto Profil"
                                 class="w-9 h-9 rounded-full object-cover border border-gray-300">
                        </td>

                        <td class="py-2 px-3">{{ $user->username ?? '-' }}</td>
                        <td class="py-2 px-3">{{ $user->email ?? '-' }}</td>
                        <td class="py-2 px-3">{{ $user->phone ?? '-' }}</td>
                        <td class="py-2 px-3">{{ $user->created_at->format('d M Y') }}</td>

                        {{-- Aksi --}}
                        <td class="py-2 px-3 text-center">
                            <div class="flex justify-center gap-3">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus pembeli ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500 text-sm">
                            Tidak ada pembeli terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
