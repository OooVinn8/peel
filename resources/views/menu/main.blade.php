@extends('layouts.app')
@include('layouts.navbar')

@section('title', 'Menu - MakanDulu')
<link rel="icon" href="{{ asset('icon.ico') }}" type="image/x-icon">
@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10">
        {{-- Card utama putih --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">

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
            {{-- Judul Halaman --}}
            <div class="text-center mb-6">
                <h1 class="text-2xl md:text-3xl font-bold">
                    Jelajahi <span class="text-blue-500">Makan</span>anMu Hari Ini
                </h1>
                <p class="text-gray-500 text-sm md:text-base">
                    Tentukan sarapanmu, makan siangmu, cemilan soremu, makan malam dan banyak lagi!
                </p>
            </div>

            {{-- Pencarian --}}
            <div class="flex justify-center mb-6">
                <form method="GET" action="{{ route('menu.main') }}" class="relative w-full md:w-1/2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu disini..."
                        class="w-full rounded-full border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 text-white px-3 py-1 rounded-full flex items-center justify-center">
                        <img src="{{ asset('images/search.png') }}" alt="Search" class="w-5 h-5 cursor-pointer">
                    </button>
                </form>
            </div>

            {{-- Kategori --}}
            <div class="flex flex-wrap gap-2 justify-center mb-8">
                @foreach ($categories as $category)
                    @php
                        $isActive = strtolower(request('category')) == strtolower($category->name);
                        $categoryUrl = $isActive
                            ? route('menu.main', ['search' => request('search')])
                            : route(
                                'menu.main',
                                array_merge(request()->only('search'), ['category' => $category->name]),
                            );
                    @endphp

                    <a href="{{ $categoryUrl }}"
                        class="px-4 py-1 rounded-full text-sm transition-all duration-200
                  {{ $isActive ? 'bg-yellow-500 text-white' : 'bg-blue-500 text-white hover:bg-yellow-400' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            {{-- Daftar Menu --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($menus as $menu)
                    <x-card.card-large-pilihan :image="asset('image_menu/' . $menu->category->name . '/' . $menu->image)" :title="$menu->name" :category="$menu->category->name" :price="'Rp' . number_format($menu->price, 0, ',', '.')"
                        :stock="$menu->stock" :link="route('menu.menu-detail', $menu->id)" :product-id="$menu->id" />
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        Menu tidak ditemukan
                    </div>
                @endforelse
            </div>


            {{-- Menu Terkait --}}
            @if (isset($relatedMenus) && $relatedMenus->count() > 0)
                <h2 class="text-xl font-semibold mt-12 mb-4 text-gray-700">Menu Terkait</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($relatedMenus as $related)
                        <a href="{{ route('menu.menu-detail', $related->id) }}">
                            <x-card.card-large-pilihan :image="asset('image_menu/' . $related->category->name . '/' . $related->image)" :title="$related->name" :category="$related->category->name"
                                :price="number_format($related->price, 0, ',', '.')" :stock="$menu->stock" />
                        </a>
                    @endforeach
                </div>
            @endif

        </div> {{-- End Card --}}
    </div>

    @include('layouts.footer')
@endsection
