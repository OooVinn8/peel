@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-bold text-gray-800">Kelola Produk</h1>
  <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">+ Tambah Produk</a>
</div>

<table class="w-full bg-white rounded-xl shadow overflow-hidden">
  <thead class="bg-gray-100 text-gray-700">
    <tr>
      <th class="py-3 px-4 text-left">#</th>
      <th class="py-3 px-4 text-left">Nama</th>
      <th class="py-3 px-4 text-left">Kategori</th>
      <th class="py-3 px-4 text-left">Harga</th>
      <th class="py-3 px-4 text-left">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $index => $product)
    <tr class="border-b hover:bg-gray-50">
      <td class="py-3 px-4">{{ $index + 1 }}</td>
      <td class="py-3 px-4">{{ $product->name }}</td>
      <td class="py-3 px-4">{{ $product->category->name }}</td>
      <td class="py-3 px-4">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
      <td class="py-3 px-4">
        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-yellow-600 hover:underline">Edit</a> |
        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
          @csrf @method('DELETE')
          <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus produk ini?')">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
