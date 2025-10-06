@extends('layouts.app')
  @include('layouts.navbar')
@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

  {{-- Title --}}
  <div class="text-center mb-6">
    <h1 class="text-2xl md:text-3xl font-bold">
      Jelajahi <span class="text-blue-500">Makan</span>anMu</span> Hari Ini
    </h1>
    <p class="text-gray-500 text-sm md:text-base">
      Tentukan sarapanmu, makan siangmu, cemilan soremu, makan malam dan banyak lagi!
    </p>
  </div>

  {{-- Search Bar --}}
  <div class="flex justify-center mb-6">
  <form method="GET" action="{{ route('menu.main') }}" class="relative w-full md:w-1/2">
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Cari menu disini..."
           class="w-full rounded-full border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none">
    <button type="submit"
            class="absolute right-2 top-1/2 -translate-y-1/2 text-white px-3 py-1 rounded-full flex items-center justify-center">
      <img src="{{ asset('images/search.png') }}" alt="Search" class="w-5 h-5">
    </button>
  </form>
</div>

  {{-- Categories --}}
  <div class="flex flex-wrap gap-2 justify-center mb-8">
    @foreach($categories as $category)
      <a href="{{ route('menu.main', ['category' => $category->id]) }}"
         class="px-4 py-1 rounded-full text-sm
                {{ request('category') == $category->id ? 'bg-blue-600 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
        {{ $category->name }}
      </a>
    @endforeach
  </div>

  {{-- Menu Grid pakai Card buatanmu --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($menus as $menu)
      <x-card.card-large-pilihan
        image="{{ asset('image_menu/'.$menu->category->name.'/'.$menu->image) }}"
        title="{{ $menu->name }}"
        category="{{ $menu->category->name }}"
        price="{{ number_format($menu->price, 0, ',', '.') }}" />
    @empty
      <div class="col-span-full text-center text-gray-500">
        Menu tidak ditemukan
      </div>
    @endforelse
  </div>
</div>
@endsection
