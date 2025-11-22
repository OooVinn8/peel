@extends('layouts.app')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-4">Upload Bukti Pembayaran</h2>

    <form action="{{ route('checkout.storeUploadPayment', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Bukti Pembayaran</label>
            <input type="file" name="payment_proof" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">
            Upload & Selesai
        </button>
    </form>
</div>
@endsection
