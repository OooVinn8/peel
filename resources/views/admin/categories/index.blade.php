@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')

{{-- Kartu Statistik Kategori --}}
<div class="flex flex-wrap gap-6 mb-6">
    <div class="flex-1 min-w-[250px] bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-gray-600 font-medium text-sm mb-1">
            Total Kategori <span class="block text-xs text-gray-400">Saat ini</span>
        </h3>
        <p class="text-4xl font-bold text-gray-800 mt-2">{{ $totalCategories }}</p>
    </div>
</div>

{{-- Search dan Tambah --}}
<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    {{-- Search --}}
    <form method="GET" action="{{ route('admin.categories.index') }}" class="relative w-full sm:w-1/2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kategori..."
            class="w-full border border-gray-300 rounded-[100px] py-2 pl-10 pr-4 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        <img src="{{ asset('images/search.png') }}" alt="Search"
            class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 opacity-70">
    </form>

    {{-- Tombol Tambah --}}
    <a href="{{ route('admin.categories.create') }}"
        class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-[100px] shadow-sm transition">
        <span class="text-lg leading-none">＋</span>
        <span>Tambah Kategori</span>
    </a>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">

    <table class="min-w-full table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">No</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">Image</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">Name</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @foreach ($categories as $category)
            <tr>
                <td class="px-6 py-4 text-gray-700 font-semibold">
                    {{ $loop->iteration }}
                </td>

                <td class="px-6 py-4">
                    <div class="relative group w-12 h-12">
                        <img src="{{ asset('image_category/' . $category->image) }}" 
                            class="w-12 h-12 object-cover border rounded cursor-pointer">

                        <div class="hidden group-hover:flex absolute -right-48 top-1/2 -translate-y-1/2 
                                    w-40 h-40 bg-white shadow-xl border rounded-lg p-2 z-50">
                            <img src="{{ asset('image_category/' . $category->image) }}" 
                                class="w-full h-full object-cover rounded-md">
                        </div>
                    </div>
                </td>

                <td class="px-6 py-4 text-gray-800 font-medium">
                    {{ $category->name }}
                </td>

                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">

                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                        class="text-yellow-600 hover:underline">Edit</a>

                        <form method="POST" 
                            action="{{ route('admin.categories.destroy', $category->id) }}"
                            onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
