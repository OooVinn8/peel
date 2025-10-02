@extends('layouts.app')z

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
  <h1 class="text-2xl font-bold mb-6">Daftar Menu</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($menus as $menu)
    <x-card.card-large-pilihan
      image="{{ asset('public/image_menu/'.$menu->category->name.'/'.$menu->image) }}"
      title="{{ $menu->name }}"
      category="{{ $menu->category->name}}"
      price="{{ number_format($menu->price, 0, ',', '.') }}" />
    @endforeach
  </div>
</div>
@endsection