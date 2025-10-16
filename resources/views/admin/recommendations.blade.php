@extends('layouts.app')
@include('layouts.navbar')

@section('content')
<div class="max-w-5xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Kelola Rekomendasi Produk</h1>

  @if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
    {{ session('success') }}
  </div>
  @endif

  <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
    <thead class="bg-blue-500 text-white">
      <tr>
        <th class="py-2 px-3 text-left">Nama Produk</th>
        <th class="py-2 px-3 text-left">Kategori</th>
        <th class="py-2 px-3 text-left">Harga</th>
        <th class="py-2 px-3 text-center">Best Seller?</th>
        <th class="py-2 px-3 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr class="border-t hover:bg-gray-50">
        <td class="py-2 px-3">{{ $product->name }}</td>
        <td class="py-2 px-3">{{ $product->category->name ?? '-' }}</td>
        <td class="py-2 px-3">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
        <td class="py-2 px-3 text-center">
          @if($product->is_recommendation)
          <span class="text-green-600 font-semibold">Ya</span>
          @else
          <span class="text-gray-400">Tidak</span>
          @endif
        </td>
        <td class="py-2 px-3 text-center">
          <form method="POST" action="{{ route('admin.recommendations.update', $product->id) }}">
            @csrf
            <button type="submit" class="px-4 py-1 rounded bg-yellow-500 text-white hover:bg-yellow-600">
              {{ $product->is_recommendation ? 'Hapus Rekomendasi' : 'Jadikan Rekomendasi' }}
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
