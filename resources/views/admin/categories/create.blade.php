@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-gray-800">Tambah Kategori</h1>
<form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow w-full max-w-md">
  @csrf
  <label class="block mb-2 text-gray-700">Nama Kategori</label>
  <input type="text" name="name" required class="w-full border rounded px-3 py-2 mb-4">
  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
</form>
@endsection
